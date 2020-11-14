<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;

class AdPriceController extends BaseAdController
{
    public function choose(Request $request)
    {
        $step = BaseAdController::STEP_CHOOSE_PRICE;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();
        $price = is_null($request->old('price')) ? $ad->price ?? '' : $request->old('price');

        return inertia('Ad/Wizard/Create', compact('step', 'price'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => ['required', 'numeric', 'regex:/^\d{1,10}\.\d{1,2}$|^\d{0,10}$/i']
        ], [
            'digits_between' => __('user::ads.form.error.price.invalid')
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $ad->price = $request->price;
        $ad->save();

        return redirect()->route('user.ad.step_phone_pictures');
    }
}
