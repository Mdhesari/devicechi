<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Models\Ad;
use Modules\User\Http\Requests\Ad\AdDemoActionRequest;

class AdDemoController extends BaseAdController
{

    public function show(Ad $ad)
    {

        $step = BaseAdController::DEMO;

        $this->checkPreviousSteps($step, $ad);

        $ad->loadSingleRelations();
        return inertia('Ad/Demo', compact('ad'));
    }

    public function publish(AdDemoActionRequest $request)
    {
        $ad = $request->ad;

        $this->adRepository->publish($ad['id']);

        return redirect()->route('user.ad.get')->with('success', __('user::ads.success.pending'));
    }

    public function delete(AdDemoActionRequest $request)
    {
        $ad = $request->ad;

        $this->adRepository->delete($ad['id']);

        return redirect()->route('user.ad.get')->with('success', __('user::ads.success.delete'));
    }

    public function archive(AdDemoActionRequest $request)
    {
        $ad = $request->ad;

        $this->adRepository->archive($ad['id']);

        return redirect()->route('user.ad.get')->with('success', __('user::ads.success.archive'));
    }
}
