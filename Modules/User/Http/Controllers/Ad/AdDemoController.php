<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Models\Ad;
use Illuminate\Http\Request;
use Modules\User\Http\Requests\Ad\AdDemoActionRequest;
use Modules\User\Http\Requests\UserAdRequest;
use Session;

class AdDemoController extends BaseAdController
{

    public function show(Ad $ad, Request $request)
    {

        if ($ad->user->id != auth()->id()) {

            return abort(403);
        }

        $warning = false;

        if ($ad->isPublished()) {
            $warning = trans('user::ads.warning.edit');
        }

        $step = BaseAdController::DEMO;

        $this->checkPreviousSteps($step, $ad);

        $ad->loadSingleRelations();

        $help = $ad->help;

        $is_bookmarked_for_user = $request->user()->bookmarkedAds()->whereAdId($ad->id)->count() > 0;

        return inertia('Ad/Demo', compact('ad', 'help', 'is_bookmarked_for_user', 'warning'));
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
