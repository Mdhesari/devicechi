<?php

namespace App\Listeners;

use App\Events\AdSuccessfullPromotionPayment;
use App\Notifications\UserNotifySuccessfulAdPromotionPayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserSuccessfullPaymentListener
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
    public function handle(AdSuccessfullPromotionPayment $event)
    {
        $event->ad->notify(new UserNotifySuccessfulAdPromotionPayment);
    }
}
