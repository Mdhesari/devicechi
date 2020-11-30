<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;

class AdAgeController extends BaseAdController
{
    public function choose()
    {
        $step = BaseAdController::STEP_CHOOSE_AGE;

        $this->checkPreviousSteps($step);

        $phone_ages = PhoneAge::all();

        $ad = $this->adRepository->getUserUncompletedAd();

        return inertia('Ad/Wizard/Create', compact('phone_ages', 'step', 'ad'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'age_id' => 'required|exists:phone_ages,id'
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $ad->phone_age_id = intval($request->age_id);
        $ad->save();

        return redirect()->route('user.ad.step_phone_price');
    }
}
