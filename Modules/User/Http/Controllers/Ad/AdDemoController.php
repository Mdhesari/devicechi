<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Events\NewAdPublishedEvent;
use App\Models\Ad;
use Illuminate\Http\Request;
use Modules\User\Http\Requests\Ad\AdDemoActionRequest;
use Modules\User\Http\Requests\UserAdRequest;
use Session;

class AdDemoController extends BaseAdController
{

    public function show(Ad $ad, Request $request)
    {
        $this->checkAuthorization($ad);

        $warning = false;

        if ($ad->isPublished()) {
            $warning = trans('user::ads.warning.edit');
        }

        $step = BaseAdController::DEMO;

        $this->checkPreviousSteps($step, $ad);

        $ad->loadSingleRelations();

        $help = $ad->help;

        $is_bookmarked_for_user = $request->user()->bookmarkedAds()->whereAdId($ad->id)->count() > 0;

        $ad->append([
            'short_url',
            'is_confirmed'
        ]);

        return inertia('Ad/Demo', compact('ad', 'help', 'is_bookmarked_for_user', 'warning'));
    }

    public function publish(AdDemoActionRequest $request)
    {
        $ad = Ad::findOrFail($request->ad['id']);

        $this->checkAuthorization($ad);

        $this->adRepository->publish($ad);

        event(new NewAdPublishedEvent($ad));

        return redirect()->route('user.ad.step_phone_demo', $ad)->with('success', __('user::ads.success.pending'));
    }

    public function delete(AdDemoActionRequest $request)
    {
        $ad = Ad::findOrFail($request->ad['id']);

        $this->checkAuthorization($ad);

        $this->adRepository->delete($ad);

        return redirect()->route('user.ad.get')->with('success', __('user::ads.success.delete'));
    }

    public function archive(AdDemoActionRequest $request)
    {
        $ad = Ad::findOrFail($request->ad['id']);

        $this->checkAuthorization($ad);

        $this->adRepository->archive($ad);

        return redirect()->route('user.ad.get')->with('success', __('user::ads.success.archive'));
    }
}
