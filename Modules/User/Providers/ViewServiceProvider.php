<?php

namespace Modules\User\Providers;

use ExportLocalization;
use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {

        View::composer('user::layouts.app', function ($view) {

            $messages = ExportLocalization::export()->toFlat();

            return $view->with(compact('messages'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
