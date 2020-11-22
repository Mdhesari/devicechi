<?php

namespace Modules\User\Space\Contracts;

use Closure;

interface ValidatesAdStep
{

    /**
     * Validate if ad
     *
     * @param   $data
     * @param  \Closure $next
     * @return mixed
     * @throws \Modules\User\Exceptions\Http\PreviousStepRedirectHttpException
     */
    public function validate($data, Closure $next);
}
