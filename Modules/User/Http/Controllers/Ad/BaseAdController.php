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
    const DEMO = 11;

    protected $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function checkPreviousSteps($step, $ad)
    {

        return $this->adRepository->checkPreviousSteps($step, $ad);
    }

    public function getStepRoute(int $step, Request $request)
    {

        $params = $request->input('params', []);

        $result = $this->evaluateStepRoute($step, $params);

        return response()->json([
            'status' => true,
            'data' => $result,
        ]);
    }

    public function getAllSteps()
    {

        $steps = [
            self::STEP_CHOOSE_BRAND,
            self::STEP_CHOOSE_MODEL,
            self::STEP_CHOOSE_VARIANT,
            self::STEP_CHOOSE_ACCESSORY,
            self::STEP_CHOOSE_AGE,
            self::STEP_CHOOSE_PRICE,
            self::STEP_UPLOAD_PICTURES,
            self::STEP_CHOOSE_LOCATION,
            self::STEP_CHOOSE_CONTACT,
            self::STEP_FINALINFO,
        ];

        return $steps;
    }

    protected function evaluateStepRoute($step, $params = [])
    {

        $back = null;
        $current = null;

        switch ($step) {

            case self::STEP_CHOOSE_BRAND:
                $current = 'user.ad.create';
                break;
            case self::STEP_CHOOSE_MODEL:
                $current = 'user.ad.step_phone_model';
                $back = 'user.ad.create';
                break;
            case self::STEP_CHOOSE_VARIANT:
                $current = 'user.ad.step_phone_model_variant';
                $back = 'user.ad.step_phone_model';
                break;
            case self::STEP_CHOOSE_ACCESSORY:
                $current = 'user.ad.step_phone_accessories';
                $back = 'user.ad.step_phone_model_variant';
                break;
            case self::STEP_CHOOSE_AGE:
                $current = 'user.ad.step_phone_age';
                $back = 'user.ad.step_phone_accessories';
                break;
            case self::STEP_CHOOSE_PRICE:
                $current = 'user.ad.step_phone_price';
                $back = 'user.ad.step_phone_age';
                break;
            case self::STEP_UPLOAD_PICTURES:
                $current = 'user.ad.step_phone_pictures';
                $back = 'user.ad.step_phone_price';
                break;
            case self::STEP_CHOOSE_LOCATION:
                $current = 'user.ad.step_phone_location';
                $back = 'user.ad.step_phone_pictures';
                break;
            case self::STEP_CHOOSE_CONTACT:
                $current = 'user.ad.step_phone_contact';
                $back = 'user.ad.step_phone_location';
                break;
            default:
                $current = 'user.ad.create';
                $back = 'user.ad.step_phone_contact';
                break;
        }

        return [
            'step' => $step,
            'current' => $current ? route($current, $params) : $current,
            'back' => $back ? route($back, $params) : $back,
        ];
    }
}
