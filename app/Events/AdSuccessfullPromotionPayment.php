<?php

namespace App\Events;

use App\Models\Ad;
use App\Models\MainUser;
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

    public $user;

    public $ad;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MainUser $user, Ad $ad)
    {
        $this->user = $user;
        $this->ad = $ad;
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
