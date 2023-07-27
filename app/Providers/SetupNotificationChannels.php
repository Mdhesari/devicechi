<?php

namespace App\Providers;

use App\Channels\GhasedakChannel;
use Illuminate\Support\ServiceProvider;
use Notification;

class SetupNotificationChannels extends ServiceProvider
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
        Notification::extend('ghasedak', function ($app) {

            return new GhasedakChannel();
        });
    }
}
