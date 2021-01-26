<?php

namespace Modules\User\Repositories\Eloquent;

use Arr;
use Auth;
use Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Log;
use App\Models\Ad;
use App\Models\Ad\AdContact;
use App\Models\Ad\AdContactType;
use Modules\User\Entities\User;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Repositories\Contracts\AdContactRepositoryInterface;
use Modules\User\Space\Contracts\CodeVerificationGenerator;
use Modules\User\Space\Pipelines\AdContact\AdContactEmailVerificationPipeline;
use Modules\User\Space\Pipelines\AdContact\AdContactPhoneVerificationPipeline;

class AdContactRepository extends Repository implements AdContactRepositoryInterface
{

    protected $contact_type_model;

    public function __construct(AdContact $adContactModel, AdContactType $adContactTypeModel)
    {
        $this->model = $adContactModel;
        $this->contact_type_model = $adContactTypeModel;
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {

        if (isset($data[0]) && is_array($data[0])) {
            $data_db = [];

            foreach ($data as $row)
                $data_db[] = $this->model->create($row);

            return $data_db;
        }

        return $this->model->create($data);
    }

    public function delete($id)
    {

        return $this->model->whereId($id)->delete();
    }

    public function getContacts($ad)
    {
        if ($ad->contacts()->count() < 1) {

            $this->createUserContact($ad->id);
        }

        $contacts = $ad->contacts()->verified()->with('type')->get();

        return $contacts;
    }

    public function createUserContact($ad_id)
    {

        $contacts = [];

        $user = Auth::user();
        $contact_types = $this->contact_type_model->get();

        if ($user->phone) {

            $data = $this->getUserPhoneData($ad_id, $contact_types, $user);

            $contacts[] = $data;
        }

        if ($user->email) {

            $data = $this->getUserEmailData($ad_id, $contact_types, $user);

            $contacts[] = $data;
        }

        return $this->create($contacts);
    }

    private function getUserPhoneData($ad_id, $contact_types, $user)
    {
        $contact_type = $contact_types->where('name', AdContactType::TYPE_PHONE)->first();

        $contact_type_id = $contact_type->id;

        $data = [
            "ad_id" => $ad_id,
            "contact_type_id" => $contact_type_id,
            "value" => $user->phone,
            "value_verified_at" => $user->phone_verified_at,
            "data" => [
                "phone_country_code" => $user->phone_country_code,
            ],
        ];

        return $data;
    }

    private function getUserEmailData($ad_id, $contact_types, $user)
    {
        $contact_type = $contact_types->where('name', AdContactType::TYPE_EMAIL)->first();
        $contact_type_id = $contact_type->id;

        $data = [
            "ad_id" => $ad_id,
            "contact_type_id" => $contact_type_id,
            "value_verified_at" => $user->phone_verified_at,
            "value" => $user->email,
        ];

        return $data;
    }

    public function firstOrCreate($data)
    {

        return $this->model->firstOrCreate($data);
    }

    /**
     * Send verification to intended user contact
     *
     * @param  mixed $ad_contact
     * @return void
     */
    public function sendVerification($ad_contact, $code)
    {

        $data = [
            'ad_contact' => $ad_contact,
            'status' => false,
            'code' => $code,
        ];

        $pipelines = config('contact.verify.pipelines', [
            AdContactEmailVerificationPipeline::class,
            AdContactPhoneVerificationPipeline::class,
        ]);

        $data = app(Pipeline::class)
            ->send($data)
            ->through($pipelines)
            ->via('send')
            ->then(function ($data) {

                return $data;
            });

        if ($data['status']) {

            return response()->json([
                'status' => true,
                'contact' => $ad_contact,
            ]);
        }

        return response()->json([
            'status' => false,
            'error' => __('Something went wrong!'),
        ]);
    }
}
