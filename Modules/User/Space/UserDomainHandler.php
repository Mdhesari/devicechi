<?php

namespace Modules\User\Space;

use Modules\Core\Contracts\DomainHanler;

class UserDomainHandler implements DomainHanler
{
    /**
     * Get custom redirect route for redirecting guess users
     *
     * @return string
     */
    public function getGuestRedirectRoute(): string
    {
        return route('user.login');
    }
}
