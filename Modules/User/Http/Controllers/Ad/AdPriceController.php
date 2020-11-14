<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdPriceController extends BaseAdController
{
    public function choose(Request $request)
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_PRICE;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();
        $price = is_null($request->old('price')) ? $ad->price ?? '' : $request->old('price');

        return inertia('Ad/Wizard/Create', compact('step', 'price'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'price' => 'required|min:1|digits_between:1,10'
        ], [
            'digits_between' => __('user::ads.form.error.price.invalid')
        ]);

        $ad = $this->adRepository->getUserUncompletedAd();

        $ad->price = $request->price;
        $ad->save();

        return redirect()->route('user.ad.create');
    }
}
