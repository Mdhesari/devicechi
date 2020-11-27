<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;

class AdDetailsController extends BaseAdController
{
    public function choose()
    {
        $step = BaseAdController::STEP_FINALINFO;

        $this->checkPreviousSteps($step);

        return inertia('Ad/Wizard/Create', compact('step'));
    }

    public function store(Request $request)
    {

        return redirect()->route('user.ad.step_phone_contact');
    }
}
