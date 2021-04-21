<?php

namespace App\Listeners;

use App\Events\AdSuccessfullPromotionPayment;
use App\Notifications\AdminAdPromotionPaymentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;
use Modules\Admin\Entities\Admin;
use Notification;

class AdminNotifySuccessfullAdPromotionPayment
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
        Notification::send(Admin::all(), new AdminAdPromotionPaymentNotification($event->ad, $event->payment));

        Log::stack(['single', 'slack'])->info(__("admin::ads.payment.promotions", [
            'user' => $event->ad->user->phone,
            'promotions' => $event->ad->printablePromotions,
            'payment' =>  $event->payment->formattedAmount
        ]));
    }
}
