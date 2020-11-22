<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Space\Contracts\ValidatesAdStep;

class BrandPipeline implements ValidatesAdStep
{

    public function validate($ad, Closure $next)
    {

        return $next($data);
    }
}
