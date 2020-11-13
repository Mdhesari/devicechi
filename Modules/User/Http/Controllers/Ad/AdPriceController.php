<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdPriceController extends BaseAdController
{
    public function choose()
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_PRICE;

        $this->checkPreviousSteps($step);

        return inertia('Ad/Wizard/Create', compact('step'));
    }
}
