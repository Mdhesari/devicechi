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

    const STEP_CHOOSE_BRAND = 1;
    const STEP_CHOOSE_MODEL = 2;
    const STEP_CHOOSE_VARIANT = 3;
    const STEP_CHOOSE_ACCESSORY = 4;
    const STEP_CHOOSE_AGE = 5;
    const STEP_CHOOSE_PRICE = 6;
    const STEP_UPLOAD_PICTURES = 7;
    const STEP_CHOOSE_LOCATION = 8;
    const STEP_CHOOSE_CONTACT = 9;
    const STEP_FINALINFO = 10;

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
