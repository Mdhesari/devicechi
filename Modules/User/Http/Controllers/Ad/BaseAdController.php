<?php

namespace Modules\User\Http\Controllers\Ad;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAccessory;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
use Modules\User\Exceptions\PhoneAccessoryIdNotFoundException;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseAdController extends Controller
{
    protected $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function checkPreviousSteps($step)
    {

        $result = $this->adRepository->checkPreviousSteps($step, auth()->user());

        if ($result['url']) {

            throw new PreviousStepRedirectHttpException($result['url']);
            // redirect($result['url']);
        }
    }
}
