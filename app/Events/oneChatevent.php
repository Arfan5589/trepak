<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class oneChatevent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $senderid;
    public $reciverid;
    public $sendmes;
    public function __construct($senderid,$reciverid,$sendmes)
    {
        Log::info(['sendmessage'=>$sendmes]);
        $this->senderid = $senderid;
        $this->reciverid = $reciverid;
        $this->sendmes = $sendmes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Log::info('Event of message work');
        return new PrivateChannel('onechat');
    }
}
