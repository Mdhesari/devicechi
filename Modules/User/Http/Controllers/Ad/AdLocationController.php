<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\AdPicture;
use Modules\User\Entities\City;
use Modules\User\Entities\CityState;
use Modules\User\Entities\Country;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;

class AdLocationController extends BaseAdController
{
    public function choose(Request $request)
    {
        $step = BaseAdController::STEP_CHOOSE_LOCATION;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();

        $user_country = Country::whereName(config('user.default_country'))->first();

        $cities = City::whereCountryId($user_country->id)->get();

        return inertia('Ad/Wizard/Create', compact('step', 'cities'));
    }

    public function store(Request $request, StoresAdPicture $driver)
    {
        //
    }

    public function getState(City $city)
    {

        $states = $city->states;

        return response()->json([
            'status' => true,
            'states' => $states,
        ]);
    }
}
