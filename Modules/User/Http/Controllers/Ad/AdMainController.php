<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use App\Models\Ad;
use Exception;
use App\Models\PhoneBrand;
use Cache;
use Modules\User\Entities\PhoneModel;
use Route;
use Str;

class AdMainController extends BaseAdController
{

    public function get(Request $request)
    {
        $ads = $request->user()->ads()->includeMediaThumb()->latest()->filterAd($request)->paginate();

        $ads->load('state.city');

        if ($request->expectsJson())
            return $ads;

        $tabs = collect([
            [
                'text' => __('user::ads.tabs.all'),
                'params' => [],
            ],
            [
                'text' => __('user::ads.tabs.accepted'),
                'params' => [
                    'status' => strtolower(Ad::STATUS_AVAILABLE_LABEL),
                ],
            ],
            [
                'text' => __('user::ads.tabs.pending'),
                'params' => [
                    'status' => strtolower(Ad::STATUS_PENDING_LABEL),
                ],
            ],
            [
                'text' => __('user::ads.tabs.rejected'),
                'params' => [
                    'status' => strtolower(Ad::STATUS_REJECTED_LABEL),
                ],
            ],
            [
                'text' => __('user::ads.tabs.uncompleted'),
                'params' => [
                    'status' => strtolower(Ad::STATUS_UNCOMPLETED_LABEL),
                ],
            ],
            [
                'text' => __('user::ads.tabs.archive'),
                'params' => [
                    'status' => strtolower(Ad::STATUS_ARCHIVE_LABEL),
                ],
            ],
            [
                'text' => __('user::ads.tabs.unavailable'),
                'params' => [
                    'status' => strtolower(Ad::STATUS_UNAVAILABLE),
                ],
            ]
        ]);

        $query_status = $request->query('status');

        $tabs = $tabs->map(function ($tab, $index) use ($query_status) {

            $tab['is_active'] = false;
            $tab['route'] = route('user.ad.get', $tab['params']);

            if (is_null($query_status)) {

                if (count($tab['params']) < 1) {
                    $tab['is_active'] = true;
                    return $tab;
                }
            } else {
                if (isset($tab['params']['status']))
                    $tab['is_active'] = $tab['params']['status'] ==  $query_status;
            }

            return $tab;
        });

        $nav_items = get_nav_items();

        return inertia('User/MyAds', compact('ads', 'tabs', 'nav_items'));
    }

    public function getStatus($status, Request $request)
    {
        $ads = $this->adRepository->getUserAds([
            'status' => intval($status),
        ]);

        return response()->json([
            'ad_status' => $status,
            'ads' => $ads,
        ]);
    }

    public function getBrands(Request $request)
    {

        $query = PhoneBrand::query();

        if ($search = $request->query('search')) $query->filterSearch($search);

        return response()->json([
            'search' => $search,
            'brands' => $query->get(),
        ]);
    }

    public function getModels(Request $request)
    {
        $query =  PhoneModel::query();

        $search = "";

        if ($brand_id = $request->query('brand_id')) {

            $query->wherePhoneBrandId($brand_id);

            if ($search = $request->query('search')) $query->filterSearch($search);
        }

        return response()->json([
            'search' => $search,
            'models' => $query->get(),
        ]);
    }

    public function bookmark(Request $request)
    {

        $request->validate([
            'ad' => ['required'],
            'attach' => ['required', 'boolean']
        ]);

        $status = true;
        $message = '';

        try {

            $query = auth()->user()->bookmarkedAds();

            if ($request->attach)
                $response = $query->attach($request->ad);
            else
                $response = $query->detach($request->ad);
        } catch (Exception $e) {

            $status = false;
            $message = $e->getMessage();
        }

        return response()->json(compact('status', 'message'));
    }

    public function disableHelpAlert(Request $request)
    {
        $user = auth()->user();

        return $user->update([
            'user_meta' => [
                Ad::HELP_ALERT_SESSION => false
            ],
        ]);
    }
}
