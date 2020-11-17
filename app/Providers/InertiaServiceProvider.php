<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Modules\User\Http\Controllers\Ad\BaseAdController;
use Request;

class InertiaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        Inertia::share('site_url', config('app.url'));

        Inertia::share('all_steps', function (Request $request) {

            $BaseAdCtrl = app(BaseAdController::class);

            if (method_exists($BaseAdCtrl, 'getAllSteps')) {

                return $BaseAdCtrl->getAllSteps();
            }

            return null;
        });

        Inertia::setRootView('user::layouts.app');
    }
}
