<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Space\Contracts\ValidatesAdStep;

class BrandPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {

        return $next($data);
    }
}
