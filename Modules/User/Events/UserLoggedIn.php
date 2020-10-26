<?php

namespace Modules\User\Events;

use Illuminate\Queue\SerializesModels;

class UserLoggedIn
{
    use SerializesModels;

    protected $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
