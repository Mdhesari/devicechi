<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\PhoneBrand;
use Modules\User\Entities\PhoneModel;

class AdModelController extends BaseAdController
{

    public function choose(PhoneBrand $brand, Ad $ad)
    {
        if ($ad)
            $this->checkAuthorization($ad);

        $step = BaseAdController::STEP_CHOOSE_MODEL;

        $this->checkPreviousSteps($step, $ad);

        if ($ad) {
            $ad->load('phoneModel');
        }

        $models = $brand->models()->excludeModel($ad)->get();

        return inertia('Ad/Wizard/Create', compact('models', 'brand', 'step', 'ad'));
    }

    public function store(PhoneBrand $brand, Ad $ad = null, Request $request)
    {

        if ($ad)
            $this->checkAuthorization($ad);

        $request->validate([
            'phone_model' => 'required|exists:phone_models,name'
        ]);

        $phone_model = $request->phone_model;

        $model = PhoneModel::whereName($phone_model)->first();

        if (!$ad) {
            // if user does not have an uncomplete ad we will create for them

            $ad = $this->adRepository->create([
                'user_id' => $request->user()->id,
            ]);
        }

        $ad->phone_model_id = $model->id;
        $ad->save();

        return redirect()->route('user.ad.step_phone_model_variant', [
            'ad' => $ad,
            'phone_model' => $phone_model,
        ]);
    }
}
