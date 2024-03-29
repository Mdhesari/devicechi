<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Models\Ad;
use App\Models\PhoneBrand;

class AdCreateController extends BaseAdController
{

    public function show(Ad $ad = null)
    {
        if ($ad) {
            $this->checkAuthorization($ad);
            $ad->load('phoneModel.brand');
            $ad->resetModel();
        }

        $step = BaseAdController::STEP_CHOOSE_BRAND;

        $phone_brands = PhoneBrand::excludeAd($ad)->get();

        return inertia('Ad/Wizard/Create', compact('phone_brands', 'step', 'ad'));
    }
}
