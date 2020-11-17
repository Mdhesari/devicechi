<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\AdPicture;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;

class AdLocationController extends BaseAdController
{
    public function choose(Request $request)
    {
        $step = BaseAdController::STEP_CHOOSE_LOCATION;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();

        return inertia('Ad/Wizard/Create', compact('step'));
    }

    public function store(Request $request, StoresAdPicture $driver)
    {
        //
    }
}
