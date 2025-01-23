<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $postId;
    public $topicId;

    public function __construct(Post $post)
    {
        $this->postId = $post->id;
        $this->topicId = $post->topic_id;

    }

    public function broadcastOn()
    {
        return new Channel('topic-' . $this->topicId);
    }

    public function broadcastWith()
    {
        return [
            'postId' => $this->postId
        ];
    }
}
