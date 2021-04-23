<?php

namespace App\Notifications;

class AdAcceptedNotification extends BaseAdReview
{
    /**
     * getTemplate
     *
     * @return string
     */
    public function getTemplate()
    {
        return 'accepted';
    }
}
