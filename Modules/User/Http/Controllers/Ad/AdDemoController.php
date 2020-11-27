<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Http\Requests\Ad\AdDetailsRequest;

class AdDemoController extends BaseAdController
{
    public function show()
    {
        $ad = $this->adRepository->getUserUncompletedAd();

        return inertia('Ad/Demo', compact('ad'));
    }

    public function store(Request $request)
    {


        return redirect()->route('user.ad.step_phone_contact');
    }
}
