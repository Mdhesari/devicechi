<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Space\Contracts\ValidatesAdStep;

class ContactPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {
        extract($data);

        if ($step >= BaseAdController::STEP_CHOOSE_CONTACT) {
            if ($ad->missingState()) {

                throw new PreviousStepRedirectHttpException(route('user.ad.step_phone_location', [
                    'ad' => $ad,
                    'phone_model' => $ad->phoneModel->name,
                ]));
            }
        }

        return $next($data);
    }
}
