<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\User\Http\Controllers\Ad\BaseAdController;
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

        Inertia::share('locale', config('app.locale'));

        Inertia::share('user', $request->user());

        Inertia::share('menu_navbar', function () {
            return get_nav_items(config('admin.navs'));
        });

        Inertia::share('site_url', config('app.url'));

        Inertia::share('success', function () {
            return session('success');
        });

        Inertia::share('flash', function () {

            return [
                'success' => session('success'),
                'error' => session('error'),
                'warning' => session('warning'),
                'toSuccess' => session('toSuccess'),
                'toError' => session('toError'),
            ];
        });

        Inertia::share('all_steps', function (Request $request) {

            $BaseAdCtrl = app(BaseAdController::class);

            if (method_exists($BaseAdCtrl, 'getAllSteps')) {

                return $BaseAdCtrl->getAllSteps();
            }

            return null;
        });

        if ($request->isModuleDomain(config('user.domain'), config('user.prefix'))) {

            Inertia::setRootView('user::layouts.app');
        }

        return $next($request);
    }
}
