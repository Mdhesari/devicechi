<?php

namespace Modules\User\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use Modules\User\Entities\User;
use Modules\User\Events\UserRegistered;

class SendPhoneVerificationCode
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
    public function handle(UserRegistered $event)
    {
        if ($code = $event->request->session()->get('verification_code')) {

            $code = is_array($code) ? $code[0] : $code;

            $number = $event->request->phone_number;

            Log::info('Mobileforsale.ir : Your verification code is ' . $code . ', number requested : ' . $number);
        }
    }
}
