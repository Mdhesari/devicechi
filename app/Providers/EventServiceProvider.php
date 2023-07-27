<?php

namespace App\Providers;

use App\Events\AdSuccessfullPromotionPayment;
use App\Events\NewAdPublishedEvent;
use App\Listeners\AdminNotifySuccessfullAdPromotionPayment;
use App\Listeners\UserSuccessfullPaymentListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Admin\Listeners\ReportNewPublishedAdToAdmin;
use Modules\User\Events\UserRegistered;
use Modules\User\Listeners\SendPhoneVerificationCode;
use Modules\User\Listeners\StorePhoneSessionVerificationCode;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // All listeners are commented because of auto discovery enabled
        Registered::class => [
            // SendEmailVerificationNotification::class,
        ],
        UserRegistered::class => [
            // SendPhoneVerificationCode::class
        ],
        NewAdPublishedEvent::class => [
            // ReportNewPublishedAdToAdmin::class,
        ],
        AdSuccessfullPromotionPayment::class => [
            // auto discovery
            // AdminNotifySuccessfullAdPromotionPayment::class,
            // UserSuccessfullPaymentListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }
}
