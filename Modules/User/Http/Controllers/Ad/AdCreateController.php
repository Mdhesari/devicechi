<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdCreateController extends Controller
{

    public function show()
    {

        $routes = [
            'ad' => [
                'create' => route('user.ad.create')
            ],
        ];

        return inertia('Ad/Wizard/Create', compact('routes'));
    }
}
