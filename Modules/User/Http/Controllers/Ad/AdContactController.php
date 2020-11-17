<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\AdPicture;
use Modules\User\Entities\City;
use Modules\User\Entities\CityState;
use Modules\User\Entities\Country;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;

class AdContactController extends BaseAdController
{
    public function choose(Request $request)
    {
        $step = BaseAdController::STEP_CHOOSE_CONTACT;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();

        return inertia('Ad/Wizard/Create', compact('step'));
    }

    public function store(Request $request)
    {
        //

        return redirect()->route('user.ad.step_phone_pictures');
    }
}
