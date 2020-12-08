<?php

namespace Modules\User\Http\Controllers\Ad;

use Closure;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\Ad;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneVariant;

class AdCreateController extends BaseAdController
{

    public function show(Ad $ad = null)
    {
        if ($ad) $ad->load('phoneModel.brand');

        $step = BaseAdController::STEP_CHOOSE_BRAND;

        $phone_brands = PhoneBrand::excludeAd($ad)->get();

        return inertia('Ad/Wizard/Create', compact('phone_brands', 'step', 'ad'));
    }
}
