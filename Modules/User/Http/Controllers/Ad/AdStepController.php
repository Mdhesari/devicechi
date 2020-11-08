<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneBrand;

class AdStepController extends Controller
{
    public function chooseModel(PhoneBrand $brand)
    {
        $route = [];

        $models = $brand->models;

        $step = 2;

        return inertia('Ad/Wizard/Create', compact('route', 'models', 'brand', 'step'));
    }
}
