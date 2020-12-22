<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use Modules\User\Entities\Ad;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Route;

class AdMainController extends BaseAdController
{

    public function get(Request $request)
    {
        // $ads = $this->adRepository->getUserAds($request);
        $ads = $request->user()->ads()->filterAd($request)->get();

        $ads->load('pictures');

        if ($request->wantsJson())
            return response()->json([
                'ads' => $ads,
            ]);

        $tabs = collect([
            [
                'text' => __('user::ads.tabs.all'),
                'params' => [],
            ],
            [
                'text' => __('user::ads.tabs.accepted'),
                'params' => [
                    'status' => Ad::STATUS_AVAILABLE,
                ],
            ],
            [
                'text' => __('user::ads.tabs.pending'),
                'params' => [
                    'status' => Ad::STATUS_PENDING,
                ],
            ],
            [
                'text' => __('user::ads.tabs.rejected'),
                'params' => [
                    'status' => Ad::STATUS_REJECTED,
                ],
            ],
            [
                'text' => __('user::ads.tabs.uncompleted'),
                'params' => [
                    'status' => Ad::STATUS_UNCOMPLETED,
                ],
            ],
            [
                'text' => __('user::ads.tabs.archive'),
                'params' => [
                    'status' => Ad::STATUS_ARCHIVE,
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
                    $tab['is_active'] = $tab['params']['status'] === intval($query_status);
            }

            return $tab;
        });

        $nav_items = get_profile_nav_items();

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
}
