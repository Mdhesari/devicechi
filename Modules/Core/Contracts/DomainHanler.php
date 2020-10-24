<?php

namespace Modules\Core\Contracts;

interface DomainHanler
{

    /**
     * Get custom redirect route for redirecting guess users
     *
     * @return string
     */
    public function getGuestRedirectRoute(): string;

}
