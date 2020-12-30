<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Space\Contracts\ValidatesAdStep;

class LocationPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {

        extract($data);

        if ($step >= BaseAdController::STEP_CHOOSE_LOCATION) {
            if ($ad->pictures()->count() < 1) {

                throw new PreviousStepRedirectHttpException(route('user.ad.step_phone_pictures', [
                    'ad' => $ad,
                    'phone_model' => $ad->phoneModel->name,
                ]));
            }
        }

        return $next($data);
    }
}
