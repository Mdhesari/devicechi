<?php

namespace Modules\Team\Space;

use Modules\Core\Contracts\DomainHanler;

class TeamDomainHandler implements DomainHanler
{
    /**
     * Get custom redirect route for redirecting guess users
     *
     * @return string
     */
    public function getGuestRedirectRoute(): string
    {
        return route('login');
    }
}
