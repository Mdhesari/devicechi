<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Modules\Core\Contracts\DomainHanler;
use Route;

class Authenticate extends Middleware
{

    protected $customSubDomainRedirects = [
        \Modules\User\Providers\RouteServiceProvider::DOMAIN,
        \Modules\Team\Providers\RouteServiceProvider::DOMAIN
    ];

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            return $this->getRedirectRoute($request);
        }
    }

    /**
     * get redirect route for authentication
     *
     * @param  mixed $request
     * @return void
     */
    private function getRedirectRoute($request)
    {

        $redirectRoute = route('home');

        foreach ($this->customSubDomainRedirects as $domain) {

            if ($request->isSubDomain($domain)) {

                $domainHandler = app($domain);

                if ($this->isNotValidDomainHandler($domainHandler)) break;

                $redirectRoute = $domainHandler->getGuestRedirectRoute();
            }
        }

        return $redirectRoute;
    }

    /**
     * check if it's a valid domain handler
     *
     * @return bool
     */
    private function isNotValidDomainHandler($domainHandler)
    {

        return is_null($domainHandler) || !$domainHandler instanceof DomainHanler;
    }
}
