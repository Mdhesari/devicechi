<?php

namespace App\Listeners;

use App\Events\UserAdIgnored;
use App\Notifications\AdIgnoredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAdIgnoredNotify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserAdIgnored $event)
    {
        $event->ad->notify(new AdIgnoredNotification);
    }
}
