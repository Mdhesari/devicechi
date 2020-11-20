<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\Ad\AdContact;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Entities\AdPicture;
use Modules\User\Entities\City;
use Modules\User\Entities\CityState;
use Modules\User\Entities\Country;
use Modules\User\Repositories\Eloquent\AdContactRepository;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;

class AdContactController extends BaseAdController
{
    public function choose(Request $request, AdContactRepository $adContactRepository)
    {
        $step = BaseAdController::STEP_CHOOSE_CONTACT;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();

        $contact_types = AdContactType::all();

        $contacts = $adContactRepository->getContacts($ad);

        return inertia('Ad/Wizard/Create', compact('step', 'contacts', 'contact_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contacts' => ['required', 'array', 'min:1'],
            'contacts.*.type' => ['required'],
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $contacts = $request->contacts;

        $all_contacts = [];

        foreach ($contacts as $contact) {

            $all_contacts[]['contact_type_id'] = $contact['type']['id'];
            $all_contacts[]['value'] = $contact['value'];
        }

        $result = $ad->contacts()->create($all_contacts);

        Log::info($result);

        return redirect()->route('user.ad.step_phone_pictures');
    }
}
