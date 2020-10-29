<?php

namespace Modules\User\Space\Contracts;

interface MustVerifyPhone
{

    public function sendVerificationNotification($code);

    public function verifyPhoneNumberIfNotVerified();
}
