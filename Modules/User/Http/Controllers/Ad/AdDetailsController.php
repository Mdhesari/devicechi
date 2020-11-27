<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Http\Requests\Ad\AdDetailsRequest;

class AdDetailsController extends BaseAdController
{
    public function choose()
    {
        $step = BaseAdController::STEP_FINALINFO;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();

        return inertia('Ad/Wizard/Create', compact('step', 'ad'));
    }

    public function store(AdDetailsRequest $request)
    {

        $ad = $this->adRepository->getUserUncompletedAd();

        $this->adRepository->updateDetails($request->all(), $ad);

        return redirect()->route('user.ad.step_phone_demo');
    }
}
