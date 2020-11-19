<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\Ad\AdContactType;
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

        $contact_types = AdContactType::all();

        $contacts = $ad->contacts()->with('type')->get()->toArray();

        if (empty($contacts)) {

            $contacts = auth()->user()->getContacts();
        }

        return inertia('Ad/Wizard/Create', compact('step', 'contacts', 'contact_types'));
    }

    public function store(Request $request)
    {
        //

        return redirect()->route('user.ad.step_phone_pictures');
    }
}
