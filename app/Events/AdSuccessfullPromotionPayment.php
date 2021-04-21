<?php

namespace App\Events;

use App\Models\Ad;
use App\Models\MainUser;
use App\Models\Payment\Payment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdSuccessfullPromotionPayment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payment;

    public $ad;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ad $ad, Payment $payment)
    {
        $this->ad = $ad;
        $this->payment = $payment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
