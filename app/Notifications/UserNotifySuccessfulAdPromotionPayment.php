<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotifySuccessfulAdPromotionPayment extends BaseAdReview
{
    /**
     * getTemplate
     *
     * @return string
     */
    public function getTemplate()
    {
        return 'promotionPayment';
    }

    public function getPlaceHolders($notifiable)
    {
        return [
            $notifiable->latestPayment()->verified_code
        ];
    }
}
