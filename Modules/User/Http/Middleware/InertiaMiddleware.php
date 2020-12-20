<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\User\Providers\RouteServiceProvider;

class InertiaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        Inertia::share('current_root', $request->root());

        Inertia::share('user', $request->user());

        if ($request->isSubDomain(RouteServiceProvider::DOMAIN)) {

            Inertia::setRootView('user::layouts.app');
        }

        return $next($request);
    }
}
