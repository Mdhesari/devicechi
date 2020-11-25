<?php

namespace Modules\User\Repositories\Eloquent;

use Arr;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Log;
use Modules\User\Entities\Ad;
use Modules\User\Entities\Ad\AdContact;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Entities\User;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Repositories\Contracts\AdContactRepositoryInterface;

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

            $this->CreateUserContacts($ad->id);
        }

        $contacts = $ad->contacts()->with('type')->get();

        return $contacts;
    }

    public function CreateUserContacts($ad_id)
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
            "value" => $user->email,
        ];

        return $data;
    }

    public function firstOrCreate($data)
    {

        return $this->model->firstOrCreate($data);
    }
}
