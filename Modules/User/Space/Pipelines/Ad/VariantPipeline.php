<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Space\Contracts\ValidatesAdStep;

class VariantPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {
        extract($data);

        if ($step >= BaseAdController::STEP_CHOOSE_VARIANT) {
            if ($ad->missingPhoneModel()) {

                throw new PreviousStepRedirectHttpException(route('user.ad.create'));
            }
        }

        return $next($data);
    }
}
