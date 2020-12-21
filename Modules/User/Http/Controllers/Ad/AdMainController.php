<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;

class AdMainController extends BaseAdController
{

    public function get(Request $request)
    {
        $ads = $this->adRepository->getUserAds();

        return response()->json([
            'ads' => $ads,
        ]);
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
