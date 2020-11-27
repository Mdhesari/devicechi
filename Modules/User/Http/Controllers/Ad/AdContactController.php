<?php

namespace Modules\User\Http\Controllers\Ad;

use App;
use Hash;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\Ad\AdContact;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Entities\AdPicture;
use Modules\User\Entities\City;
use Modules\User\Entities\CityState;
use Modules\User\Entities\Country;
use Modules\User\Http\Requests\Ad\AdContactVerifyRequest;
use Modules\User\Repositories\Contracts\AdContactRepositoryInterface;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;
use Modules\User\Repositories\Eloquent\AdContactRepository;
use Modules\User\Space\Contracts\CodeVerificationGenerator;
use Modules\User\Space\Contracts\StoresAdPicture;
use Modules\User\Space\Pipelines\AdContact\AdContactEmailVerificationPipeline;
use Modules\User\Space\Pipelines\AdContact\AdContactPhoneVerificationPipeline;
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
            'value.required' => __("user::ads.form.error.contact.value.title"),
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $ad_contact = $adContactRepository->create([
            'contact_type_id' => $request->contact_type['id'],
            'ad_id' => $ad->id,
            'value' => $request->value
        ]);

        $code = app(CodeVerificationGenerator::class)->generate();

        $ad_contact->setVerificationCode($code);

        if (App::environment('testing'))
            session()->put('test_code', $code);

        session([
            AdContact::VERIFICATION_SESSION => Hash::make($code),
        ]);

        return $adContactRepository->sendVerification($ad_contact);
    }

    public function verify(AdContactVerifyRequest $request, AdContactRepository $adContactRepository)
    {

        $verification_code = $request->verification_code;

        $hashed_value = session(AdContact::VERIFICATION_SESSION);

        if (Hash::check($verification_code, $hashed_value)) {

            $ad_contact = $adContactRepository->find($request->ad_contact_id);

            $result = $ad_contact->setValueAsVerified();

            return response()->json([
                'status' => boolval($result),
                'result' => $result,
            ]);
        }

        return response()->json([
            'status' => false,
            'error' => __('user::ads.form.error.verify.title'),
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
