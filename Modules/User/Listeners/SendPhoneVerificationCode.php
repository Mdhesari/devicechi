<?php

namespace Modules\User\Listeners;

use Hash;
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
        $code = $this->generateActivationCode();

        $number = $event->request->phone;

        Log::info('Mobileforsale.ir : Your verification code is ' . $code . ', number requested : ' . $number);

        $code = Hash::make($code);

        $event->request->session()->put('phone', $number);
        $event->request->session()->put('verification_code', $code);
    }

    /**
     * Generate activation code
     *
     * @return void
     */
    private function generateActivationCode()
    {

        return rand(10000, 99999);
    }
}
