<?php

namespace Modules\User\Space;

use Modules\User\Space\Contracts\CodeVerificationGenerator;

class GeneratorVerification implements CodeVerificationGenerator
{

    /**
     * Generate verification code
     *
     * @return int|mixed
     */
    public function generate(int $length = null)
    {
        $number = '';

        if (is_null($length))
            $length = config('user.verification_length', 5);

        for ($i = 0; $i < $length; $i++) {

            $number .= rand(1, 9);
        }

        return $number;
    }
}
