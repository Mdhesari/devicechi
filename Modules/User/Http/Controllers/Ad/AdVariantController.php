<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\Entities\Ad;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;

class AdVariantController extends BaseAdController
{

    public function choose(Ad $ad, PhoneModel $model)
    {
        $step = BaseAdController::STEP_CHOOSE_VARIANT;

        $this->checkPreviousSteps($step);

        $phone_model_variants = $model->variants;

        $brand = $model->brand;

        return inertia('Ad/Wizard/Create', compact('phone_model_variants', 'step', 'model', 'brand', 'ad'));
    }

    public function store(Ad $ad, PhoneModel $model, Request $request)
    {

        $request->validate([
            'variant_id' => 'required|exists:phone_variants,id'
        ]);

        $ad->phone_model_variant_id = $request->variant_id;
        $ad->save();

        return redirect()->route('user.ad.step_phone_accessories', [
            'ad' => $ad,
        ]);
    }
}
