<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $message;
    //public $afterCommit = true;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('chat-room.' . $this->message->chat_room_id);
    }

    public function broadcastWith()
{
    return [
        'content' => $this->message->content,
        'user' => [
            'id' => $this->message->user->id,
            'name' => $this->message->user->name,
        ],
        'created_at' => $this->message->created_at->format('Y-m-d H:i:s'),
    ];
}

}
