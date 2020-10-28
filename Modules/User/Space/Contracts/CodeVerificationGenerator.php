<?php

namespace Modules\User\Space\Contracts;

interface CodeVerificationGenerator
{

    /**
     * Generate verification code
     *
     * @return int|mixed
     */
    public function generate(int $length = null);
}
