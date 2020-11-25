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
use Modules\User\Repositories\Contracts\AdContactRepositoryInterface;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;
use Modules\User\Repositories\Eloquent\AdContactRepository;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;

class AdContactController extends BaseAdController
{
    public function choose(Request $request, AdContactRepositoryInterface $adContactRepository)
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


        return redirect()->route('user.ad.step_phone_pictures');
    }

    public function add(Request $request, AdContactRepositoryInterface $adContactRepository)
    {

        $request->validate([
            'contact_type' => ['required'],
            'contact_type.id' => ['exists:ad_contact_types,id'],
            'value' => ['required']
        ], [
            'value.required' => trans("user::ads.form.error.contact.value.title"),
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $ad_contact = $adContactRepository->firstOrCreate([
            'contact_type_id' => $request->contact_type['id'],
            'ad_id' => $ad->id,
            'value' => $request->value
        ]);
        

        /* TODO : 
        1. create contact
        2. send verification code 

        -> 2 
        1. verify code 
        2. add latest timestamp to value_verified_at
        */

        $ad_contact = $ad_contact->with('type')->find($ad_contact->id);

        return response()->json([
            'status' => boolval($ad_contact),
            'contact' => $ad_contact
        ]);
    }

    public function remove(Request $request, AdContactRepositoryInterface $adContactRepository)
    {

        $request->validate([
            'contact_id' => ['required', 'exists:ad_contacts,id']
        ]);

        $result = $adContactRepository->delete($request->contact_id);

        $ad = $this->adRepository->getUserUncompletedAd();

        $contacts = $adContactRepository->getContacts($ad);

        return response()->json([
            'status' => boolval($result),
            'result' => $request,
            'contacts' => $contacts,
        ]);
    }
}
