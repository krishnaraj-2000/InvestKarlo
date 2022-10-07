<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserWalletDeposit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $previous_balance ;
    public $current_balance ;
    public $user_id ;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($previous_balance , $current_balance , $user_id )
    {
        //
        $this->previous_balance = $previous_balance ;
        $this->current_balance = $current_balance ;
        $this->user_id = $user_id ;
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
