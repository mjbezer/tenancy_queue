<?php

namespace AtitudeAgenda\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ValidationNewClient
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $database;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getDatabase()
    {
        return $this->database;
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
