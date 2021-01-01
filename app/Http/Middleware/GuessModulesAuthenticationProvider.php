<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Admin\Http\Middleware\SetAdminAuthenticationProvider;

class GuessModulesAuthenticationProvider
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

        $currentRootHost = get_url_host($request->root());

        $adminHost = get_url_host(config('admin.domain'));
        $adminPrefix = trim(config('admin.prefix'), '/');

        $has_prefix = $this->checkDomainPrefixMatch($request, $adminPrefix);

        // check if is admin <url></url>
        if ($currentRootHost == $adminHost && $has_prefix)
            return app(SetAdminAuthenticationProvider::class)->handle($request, $next);

        // add other modules domain check... we dont do that for main module as its auth provider is the default provider

        return $next($request);
    }

    protected function checkDomainPrefixMatch($request, $prefix): bool
    {

        return empty($prefix) ? true : $request->is([$prefix, $prefix . '/*']);
    }
}
