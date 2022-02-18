<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SaveLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $weather;
    public $type;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        array $weather,
        int $type,
        ?User $user = null)
    {
        $this->user = $user;
        $this->type = $type;
        $this->weather = $weather;
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
