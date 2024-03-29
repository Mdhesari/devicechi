<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use App\Models\Ad;
use Modules\User\Entities\City;
use Modules\User\Entities\Country;

class AdLocationController extends BaseAdController
{
    public function choose(Ad $ad, Request $request)
    {
        $this->checkAuthorization($ad);

        $step = BaseAdController::STEP_CHOOSE_LOCATION;

        $this->checkPreviousSteps($step, $ad);

        $user_country = Country::whereName(config('user.default_country'))->first();

        $cities = City::whereCountryId($user_country->id)->get();

        $state = $ad->state;

        $city = optional($state)->city;

        $states = optional($city)->states ?: [];

        return inertia('Ad/Wizard/Create', compact('step', 'cities', 'ad', 'city', 'state', 'states'));
    }

    public function store(Ad $ad, Request $request)
    {
        $this->checkAuthorization($ad);

        $request->validate([
            'city' => ['required', 'numeric', 'exists:cities,id'],
            'state' => ['required', 'numeric', 'exists:city_states,id'],
        ]);

        $ad->state_id = $request->state;
        $ad->save();

        return redirect()->route('user.ad.step_phone_contact', [
            'ad' => $ad,
        ]);
    }

    public function getState(Ad $ad, City $city)
    {
        $this->checkAuthorization($ad);

        $states = $city->states;

        return response()->json([
            'status' => true,
            'states' => $states,
        ]);
    }
}
