<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Ad;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Http\Requests\Ad\AdDetailsRequest;

class AdDetailsController extends BaseAdController
{
    public function choose(Ad $ad)
    {
        $step = BaseAdController::STEP_FINALINFO;

        $this->checkPreviousSteps($step, $ad);

        return inertia('Ad/Wizard/Create', compact('step', 'ad'));
    }

    public function store(Ad $ad, AdDetailsRequest $request)
    {

        if (is_null($ad->title))
            $ad->slug = null;

        $this->adRepository->updateDetails($request->all(), $ad);

        return redirect()->route('user.ad.step_phone_demo', [
            'ad' => $ad,
        ]);
    }
}
