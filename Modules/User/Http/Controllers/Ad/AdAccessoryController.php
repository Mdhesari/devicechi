<?php

namespace Modules\User\Http\Controllers\Ad;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\Entities\Ad;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Exceptions\PhoneAccessoryIdNotFoundException;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdAccessoryController extends BaseAdController
{

    public function choose(Ad $ad, Request $request)
    {
        $step = BaseAdController::STEP_CHOOSE_ACCESSORY;

        $this->checkPreviousSteps($step, $ad);

        $accessories = PhoneAccessory::all();

        $phone_model = $ad->phoneModel;

        $selected_accessories = $ad->accessories->pluck('id')->toArray();
        $selected = [];

        foreach ($accessories as $acc) {

            $value = in_array($acc->id, $selected_accessories);

            if ($value)
                $selected[$acc->id] = $acc->id;
        }

        return inertia('Ad/Wizard/Create', compact('accessories', 'selected', 'step', 'phone_model', 'ad'));
    }

    public function store(Ad $ad, Request $request)
    {

        $request->validate([
            'accessories' => 'required|array'
        ]);

        $acceesories = collect($request->accessories);

        $acceesories = $acceesories->filter(function ($value) {

            return !is_null($value) && !empty($value) && PhoneAccessory::whereId($value)->count() > 0;
        });

        $result = $ad->accessories()->sync($acceesories);

        return $result ? redirect()->route('user.ad.step_phone_age', [
            'ad' => $ad
        ]) : redirect()->back();
    }
}
