<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Space\Contracts\ValidatesAdStep;

class PicturesPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {

        extract($data);

        if ($step >= BaseAdController::STEP_UPLOAD_PICTURES) {
            if ($ad->missingPrice()) {

                throw new PreviousStepRedirectHttpException(route('user.ad.step_price'));
            }
        }

        return $next($data);
    }
}
