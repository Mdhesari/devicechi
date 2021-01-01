<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Modules\Core\Contracts\DomainHanler;
use Route;

class Authenticate extends Middleware
{

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

        return route('user.login');
    }
}
