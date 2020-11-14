<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Models\Ad;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;
use Modules\User\Exceptions\UserAdCreationFailed;

class AdModelController extends BaseAdController
{

    public function choose(PhoneBrand $brand)
    {
        $step = BaseAdController::STEP_CHOOSE_MODEL;

        $this->checkPreviousSteps($step);

        $models = $brand->models;

        return inertia('Ad/Wizard/Create', compact('models', 'brand', 'step'));
    }

    public function store(PhoneBrand $brand, Request $request)
    {

        $request->validate([
            'phone_model' => 'required|exists:phone_models,name'
        ]);

        $phone_model = $request->phone_model;

        $ad = $this->adRepository->getUserUncompletedAd();
        $model = PhoneModel::whereName($phone_model)->first();

        if (!$ad) {


            $ad = $this->adRepository->create([
                'user_id' => auth()->id(),
            ]);
        }

        $ad->phone_model_id = $model->id;
        $ad->save();

        return redirect()->route('user.ad.step_phone_model_variant', [
            'phone_model' => $phone_model,
        ]);
    }
}
