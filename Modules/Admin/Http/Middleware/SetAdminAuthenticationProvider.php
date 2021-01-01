<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Config;
use Illuminate\Http\Request;

class SetAdminAuthenticationProvider
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

        Config::set('auth.providers.users.model', \Modules\Admin\Entities\Admin::class);

        return $next($request);
    }
}
