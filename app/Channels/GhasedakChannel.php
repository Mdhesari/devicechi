<?php

namespace App\Channels;

use Arr;
use Exception;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;
use Log;

class GhasedakChannel
{

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $mobile = $notifiable->routeNotificationFor('sms', $notification);

        if (!$mobile) return report(
            new Exception(
                sprintf('Mobile not found for notification : %s, Notifiable : %s', get_class($notification), get_class($notifiable))
            )
        );

        $ghasedak = $notification->toGhasedak($notifiable);

        if (!isset($ghasedak['template']) || !isset($ghasedak['placeholders']))
            report(new Exception('toGhasedak method is invalid.'));

        $template = $ghasedak['template'];

        $placeholders = $ghasedak['placeholders'];

        $default_line_number = config('ghasedak.default_line');

        $line = Arr::get(config('ghasedak.lines'), $default_line_number);

        try {

            $api = new GhasedakApi(config('ghasedak.api_key'));

            // TODO use default line
            // $result = $api->SendSimple(
            //     $mobile,  // receptor
            //     $message, // message
            //     $line, // choose a line number from your account
            // );

            $api->verify(
                $mobile,
                $type = 1,
                $template,
                $placeholders
            );
        } catch (Exception $e) {

            report($e);
        }
    }
}
