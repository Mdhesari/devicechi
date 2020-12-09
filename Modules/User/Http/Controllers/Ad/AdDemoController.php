<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Ad;
use Modules\User\Entities\PhoneAge;
use Modules\User\Entities\PhoneModel;
use Modules\User\Http\Requests\Ad\AdDemoActionRequest;
use Modules\User\Http\Requests\Ad\AdDetailsRequest;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdDemoController extends BaseAdController
{

    public function show(Ad $ad)
    {

        $step = BaseAdController::DEMO;

        $this->checkPreviousSteps($step);

        $ad = $ad->load(['phoneModel', 'phoneModel.brand', 'pictures', 'variant']);

        return inertia('Ad/Demo', compact('ad'));
    }

    public function publish(AdDemoActionRequest $request)
    {
        $ad = $request->ad;

        $this->adRepository->publish($ad['id']);

        return redirect()->route('user.dashboard')->with('success', __('user::ads.success.pending'));
    }

    public function delete(AdDemoActionRequest $request)
    {
        $ad = $request->ad;

        $this->adRepository->delete($ad['id']);

        return redirect()->route('user.dashboard')->with('success', __('user::ads.success.delete'));
    }

    public function archive(AdDemoActionRequest $request)
    {
        $ad = $request->ad;

        $this->adRepository->archive($ad['id']);

        return redirect()->route('user.dashboard')->with('success', __('user::ads.success.archive'));
    }
}
