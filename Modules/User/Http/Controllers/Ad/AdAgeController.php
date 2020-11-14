<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdAgeController extends BaseAdController
{
    public function choose()
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_AGE;

        $this->checkPreviousSteps($step);

        $phone_ages = PhoneAge::all();

        return inertia('Ad/Wizard/Create', compact('phone_ages', 'step'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'age_id' => 'required|exists:phone_ages,id'
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $ad->phone_age_id = $request->age_id;
        $ad->save();

        return redirect()->route('user.ad.step_phone_price');
    }
}
