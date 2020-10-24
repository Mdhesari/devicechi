<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
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

        $hostArr =  explode('.', $request->getHost());

        $redirectRoute = route('home');

        if (count($hostArr) > 2) {
            // uses sub domain

            switch ($hostArr[0]) {

                case \Modules\User\Providers\RouteServiceProvider::DOMAIN:
                    $redirectRoute = route('user.login');
                    break;
                case \Modules\Team\Providers\RouteServiceProvider::DOMAIN:
                    $redirectRoute = route('login');
            }
        }

        return $redirectRoute;
    }
}
