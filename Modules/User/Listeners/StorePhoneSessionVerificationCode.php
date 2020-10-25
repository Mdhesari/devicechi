<?php

namespace Modules\User\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Events\UserRegistered;

class StorePhoneSessionVerificationCode
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

        $event->request->session()->push('phone_number', $event->request->phone_number);
        $event->request->session()->push('verification_code', $code);
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
