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
        $ads = $request->user()->ads()->with('pictures')->get();

        return response()->json([
            'ads' => $ads,
        ]);
    }

    public function getStatus($status, Request $request)
    {

        $ads = $request->user()->ads()->whereStatus(intval($status))->get();

        return response()->json([
            'ad_status' => $status,
            'ads' => $ads,
        ]);
    }
}
