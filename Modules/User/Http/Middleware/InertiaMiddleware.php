<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Modules\User\Providers\RouteServiceProvider;
use SEOMeta;

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
        $head_title = trans('user::global.head.title', [
            'app_name' => config('app.name')
        ]);

        SEOMeta::setTitle($head_title);

        Inertia::share('current_root', $request->root());

        Inertia::share('locale', config('app.locale'));

        Inertia::share('user', $request->user());

        Inertia::share('menu_navbar', function () {
            if (auth()->user())
                return get_nav_items(config('admin.auth_navs'));

            return get_nav_items(config('admin.guest_navs'));
        });

        Inertia::share('footer_navbar', function () {

            return get_nav_items(config('admin.footer_navs'));
        });

        Inertia::share('site_url', config('app.url'));

        Inertia::share('head_title',  $head_title);

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
