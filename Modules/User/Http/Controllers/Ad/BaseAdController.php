<?php

namespace Modules\User\Http\Controllers\Ad;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Exceptions\PhoneAccessoryIdNotFoundException;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class BaseAdController extends Controller
{
    protected $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function checkPreviousSteps($step, $user)
    {

        $result = $this->adRepository->checkPreviousSteps($step, $user);

        if ($result['url']) {

            return redirect($result['url']);
        }
    }
}
