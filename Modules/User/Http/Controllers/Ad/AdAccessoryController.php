<?php

namespace Modules\User\Http\Controllers\Ad;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Exceptions\PhoneAccessoryIdNotFoundException;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdAccessoryController extends BaseAdController
{

    public function choose(Request $request)
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_ACCESSORY;

        if ($this->adRepository->alreadyHaveDoneStep($step, auth()->user())) {

            return redirect()->route('user.ad.create');
        }

        $accessories = PhoneAccessory::all();

        return inertia('Ad/Wizard/Create', compact('accessories', 'step'));
    }

    public function store(Request $request, AdRepositoryInterface $repository)
    {

        $request->validate([
            'accessories' => 'required|array'
        ]);

        $acceesories = collect($request->accessories);

        $acceesories = $acceesories->filter(function ($value) {

            return !is_null($value) && !empty($value) && PhoneAccessory::whereId($value)->count() > 0;
        });

        $result = $repository->saveAccessories($acceesories, auth()->user());

        return $result ? redirect('user.ad.step_choose_age') : redirect()->back();
    }
}
