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
        $mobile = $notifiable->routeNotificationFor('sms', $notification) ?? $notifiable->phone;

        if (!$mobile) return;

        // TODO custom dynamic message
        $message = $notification->toGhasedak($notifiable);

        $code = $notification->getCode($notifiable);

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
                $template = 'confirmation',
                $code
            );
        } catch (Exception $e) {

            report($e);
        }
    }
}
