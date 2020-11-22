<?php

namespace Modules\User\Space\Pipelines\Ad;

use Closure;
use Modules\User\Space\Contracts\ValidatesAdStep;

class ContactPipeline implements ValidatesAdStep
{

    public function validate($data, Closure $next)
    {
        extract($data);

        return $next($data);
    }
}
