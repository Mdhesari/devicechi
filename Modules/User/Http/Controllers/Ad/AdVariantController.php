<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdVariantController extends BaseAdController
{

    public function choose(PhoneModel $model)
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_VARIANT;

        $this->checkPreviousSteps($step);

        $phone_model_variants = $model->variants;

        return inertia('Ad/Wizard/Create', compact('phone_model_variants', 'step', 'model'));
    }

    public function store(PhoneModel $model, Request $request)
    {

        $request->validate([
            'variant_id' => 'required|exists:phone_variants,id'
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $ad->phone_model_variant_id = $request->variant_id;
        $ad->save();

        return redirect()->route('user.ad.step_phone_accessories');
    }
}
