<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Exceptions\Http\PreviousStepRedirectHttpException;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Space\Contracts\ValidatesAdStep;

class DemoPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {
        extract($data);

        if ($step >= BaseAdController::DEMO) {
            if ($ad->missingDetails()) {

                throw new PreviousStepRedirectHttpException(route('user.ad.step_phone_details', [
                    'ad' => $ad,
                ]));
            }
        }

        return $next($data);
    }
}
