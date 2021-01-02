<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdPriceController extends BaseAdController
{
    public function choose(Ad $ad, Request $request)
    {
        $step = BaseAdController::STEP_CHOOSE_PRICE;

        $this->checkPreviousSteps($step, $ad);

        $price = $request->old('price', $ad->price ?? "");

        $is_exchangeable = $ad->is_exchangeable;

        return inertia('Ad/Wizard/Create', compact('step', 'price', 'ad', 'is_exchangeable'));
    }

    public function store(Ad $ad, Request $request)
    {
        $request->validate([
            'price' => ['required', 'numeric', 'regex:/^\d{1,10}\.\d{1,2}$|^\d{0,10}$/i'],
            'is_exchangeable' => ['nullable']
        ], [
            'digits_between' => __('user::ads.form.error.price.invalid')
        ]);

        $ad->price = $request->price;
        $ad->is_exchangeable = $request->boolean('is_exchangeable', false);
        $ad->save();

        return redirect()->route('user.ad.step_phone_pictures', [
            'ad' => $ad,
        ]);
    }
}
