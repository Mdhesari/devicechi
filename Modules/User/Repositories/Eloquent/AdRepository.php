<?php

namespace Modules\User\Repositories\Eloquent;

use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\User\Entities\Ad;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdRepository extends Repository implements AdRepositoryInterface
{

    public function __construct(Ad $adModel)
    {
        $this->model = $adModel;
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function checkPreviousSteps(int $step, $user)
    {

        $result = [
            'url' => null,
        ];
        $ad = $user->ads()->uncompleted()->first();

        if ($step > AdRepositoryInterface::STEP_CHOOSE_MODEL) {

            if (!$ad) {

                $result['url'] = route('user.ad.create');
                return $result;
            }
        }

        if ($step >= AdRepositoryInterface::STEP_CHOOSE_VARIANT) {
            if ($ad->missingPhoneModel()) {

                $result['url'] = route('user.ad.create');
            }
        }

        if ($step >= AdRepositoryInterface::STEP_CHOOSE_ACCESSORY) {
            if ($ad->missingPhoneModelVariant()) {

                $result['url'] = route('user.ad.step_phone_model_variant', [
                    'phone_model' => $ad->phoneModel->name,
                ]);
            }
        }

        if ($step >= AdRepositoryInterface::STEP_CHOOSE_AGE) {
            // $result = $ad->missingPhoneAccessories();
        }

        if ($step >= AdRepositoryInterface::STEP_CHOOSE_PRICE) {
            if ($ad->missingPhoneAge()) {

                $result['url'] = route('user.ad.step_phone_age');
            }
        }

        if ($step >= AdRepositoryInterface::STEP_UPLOAD_PICTURES) {
            if ($ad->missingPrice()) {

                $result['url'] = route('user.ad.step_price');
            }
        }

        return $result;
    }

    public function saveAccessories($accessories, User $user)
    {

        $ad = $user->ads()->uncompleted()->firstOrFail();

        return $ad->accessories()->sync($accessories);
    }

    public function getUserUncompletedAd()
    {

        return auth()->user()->ads()->uncompleted()->first();
    }
}
