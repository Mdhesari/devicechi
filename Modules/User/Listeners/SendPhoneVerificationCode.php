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

        $event->request->session()->push('veritication_code', Hash::make($code));

        $number = $event->request->phone;

        $event->request->session()->push('phone', $number);
        $event->request->session()->push('verification_code', $code);

        Log::info('Mobileforsale.ir : Your verification code is ' . $code . ', number requested : ' . $number);
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
