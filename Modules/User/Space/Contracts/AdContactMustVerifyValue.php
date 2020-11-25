<?php

namespace Modules\User\Space\Contracts;

interface AdContactMustVerifyValue
{

    public function setVerificationCode($code);

    public function getVerificationCode();
}
