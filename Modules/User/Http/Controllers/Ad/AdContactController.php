<?php

namespace Modules\User\Http\Controllers\Ad;

use App;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Log;
use Modules\User\Entities\Ad;
use Modules\User\Entities\Ad\AdContact;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Http\Requests\Ad\AdContactVerifyRequest;
use Modules\User\Repositories\Contracts\AdContactRepositoryInterface;
use Modules\User\Repositories\Eloquent\AdContactRepository;
use Modules\User\Space\Contracts\CodeVerificationGenerator;
use Validator;

class AdContactController extends BaseAdController
{
    public function choose(Ad $ad, Request $request, AdContactRepositoryInterface $adContactRepository)
    {
        $step = BaseAdController::STEP_CHOOSE_CONTACT;

        $this->checkPreviousSteps($step, $ad);

        $contact_types = AdContactType::all();

        $contacts = $adContactRepository->getContacts($ad);

        return inertia('Ad/Wizard/Create', compact('step', 'contacts', 'contact_types', 'ad'));
    }

    public function store(Ad $ad, Request $request)
    {

        if (!$ad->contacts()->verified()->count()) {

            throw ValidationException::withMessages([
                'contacts' => __('validation.required', [
                    'attribute' => __('user::ads.form.attrs.contacts')
                ])
            ]);
        }

        return redirect()->route('user.ad.step_phone_details', [
            'ad' => $ad,
        ]);
    }

    public function add(Ad $ad, Request $request, AdContactRepositoryInterface $adContactRepository)
    {

        $request->validate([
            'contact_type' => ['required'],
            'contact_type.id' => ['required', 'exists:ad_contact_types,id'],
            'value' => ['required'] // 'unique:ad_contacts,value,except,id'
        ], [
            'value.required' => __("user::ads.form.error.contact.value.title"),
            'value.unique' => __("user::ads.form.error.contact.duplicate.title")
        ]);

        $contact_type = AdContactType::find($request->contact_type['id']);
        Log::info($contact_type);
        if ($contact_type->data['validation']) {

            Validator::validate([
                'value' => $request->value,
            ], $contact_type->data['validation'], [], $contact_type->data['validation_attr'] ?? []);
        }

        $ad_contact = $adContactRepository->firstOrCreate([
            'contact_type_id' => $contact_type->id,
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

    public function verify(Ad $ad, AdContactVerifyRequest $request, AdContactRepository $adContactRepository)
    {

        $verification_code = $request->verification_code;

        $hashed_value = session(AdContact::VERIFICATION_SESSION);

        if (Hash::check($verification_code, $hashed_value)) {

            $ad_contact = $adContactRepository->find($request->ad_contact_id);

            $result = $ad_contact->setValueAsVerified();

            $ad_contact = $ad_contact->with('type')->find($ad_contact->id);

            return response()->json([
                'status' => boolval($result),
                'contact' => $ad_contact,
            ]);
        }

        return response()->json([
            'status' => false,
            'error' => __('user::ads.form.error.contact.verify.title'),
        ]);
    }

    public function remove(Ad $ad, Request $request, AdContactRepositoryInterface $adContactRepository)
    {

        $request->validate([
            'contact_id' => ['required', 'exists:ad_contacts,id']
        ]);

        $result = $adContactRepository->delete($request->contact_id);

        $contacts = $adContactRepository->getContacts($ad);

        return response()->json([
            'status' => boolval($result),
            'result' => $request,
            'contacts' => $contacts,
        ]);
    }
}
