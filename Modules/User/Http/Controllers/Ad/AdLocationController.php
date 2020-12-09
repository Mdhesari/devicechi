<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\Ad;
use Modules\User\Entities\AdPicture;
use Modules\User\Entities\City;
use Modules\User\Entities\CityState;
use Modules\User\Entities\Country;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;

class AdLocationController extends BaseAdController
{
    public function choose(Ad $ad, Request $request)
    {
        $step = BaseAdController::STEP_CHOOSE_LOCATION;

        $this->checkPreviousSteps($step);

        $user_country = Country::whereName(config('user.default_country'))->first();

        $cities = City::whereCountryId($user_country->id)->get();

        $state = $ad->state;
        $city = optional($state)->city;

        $states = optional($city)->states ?: [];

        return inertia('Ad/Wizard/Create', compact('step', 'cities', 'ad', 'city', 'state', 'states'));
    }

    public function store(Ad $ad, Request $request)
    {
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

        $states = $city->states;

        return response()->json([
            'status' => true,
            'states' => $states,
        ]);
    }
}
