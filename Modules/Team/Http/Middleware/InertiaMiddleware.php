<?php

namespace Modules\Team\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Team\Providers\RouteServiceProvider;

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

        if ($request->isSubDomain(RouteServiceProvider::DOMAIN)) {
            Inertia::setRootView('team::layouts.team');
        }

        return $next($request);
    }
}
