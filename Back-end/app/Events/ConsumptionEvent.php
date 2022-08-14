<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
// 1
class ConsumptionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $afterCommit = true;
    private $user_id, $consumption;
    // 2
    public function __construct($user_id, $consumption)
    {
        $this->user_id = $user_id;
        $this->consumption = $consumption;
    }
    // 3
    public function broadcastWith()
    {
        return [
            'id' => $this->user_id,
            'consumption' => $this->consumption,
        ];
    }
    // 4
    public function broadcastAs()
    {
        return 'consumption.new';
    }
    // 5
    public function broadcastOn()
    {
        return new Channel('public.room');
    }
}


