<?php

namespace App\Listeners;

use App\Events\UserAdAccepted;
use App\Notifications\AdAcceptedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserAdAcceptedNotify
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
    public function handle(UserAdAccepted $event)
    {
        $event->ad->notify(new AdAcceptedNotification);
    }
}
