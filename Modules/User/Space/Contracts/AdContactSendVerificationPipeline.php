<?php

namespace Modules\User\Space\Contracts;

use Closure;

interface AdContactSendVerificationPipeline
{

    public function send($ad, Closure $next);
}
