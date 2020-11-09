<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneVariant;

class AdCreateController extends Controller
{

    public function show()
    {

        $routes = [
            'ad' => [
                'create' => route('user.ad.create')
            ]
        ];

        $step = 1;

        $phone_brands = PhoneBrand::all();

        return inertia('Ad/Wizard/Create', compact('routes', 'phone_brands', 'step'));
    }
}
