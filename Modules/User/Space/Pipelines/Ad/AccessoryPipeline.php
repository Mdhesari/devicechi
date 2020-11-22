<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Space\Contracts\ValidatesAdStep;

class AccessoryPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {

        extract($data);

        if ($step >= BaseAdController::STEP_CHOOSE_ACCESSORY) {
            if ($ad->missingPhoneModelVariant()) {

                throw new PreviousStepRedirectHttpException(route('user.ad.step_phone_model_variant', [
                    'phone_model' => $ad->phoneModel->name,
                ]));
            }
        }

        return $next($data);
    }
}
