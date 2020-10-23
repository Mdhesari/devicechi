<?php

namespace Modules\Team\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;
use Modules\Team\View\Components\GuestLayout;

class BladeServiceProvider extends ServiceProvider
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function boot()
    {
        Blade::component('guest-layout', GuestLayout::class);
    }
}
