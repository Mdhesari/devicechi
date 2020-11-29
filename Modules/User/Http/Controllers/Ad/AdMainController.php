<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

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
}
