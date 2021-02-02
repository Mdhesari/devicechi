<?php

namespace App\Notifications;

use App\Models\Ad;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Log;

class AdIgnoredNotification extends BaseAdReview
{
    /**
     * getTemplate
     *
     * @return string
     */
    public function getTemplate()
    {
        return 'ignored';
    }
}
