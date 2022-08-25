<?php

namespace App\Repositories;

use App\Http\Resources\Message\MessageResource;
use App\Interfaces\MessageInterface;
use App\Models\Message;

class MessageRepository implements MessageInterface
{
    public function sendMessage($data)
    {
        Message::create($data);
    }

    public function Messages($data)
    {
        $messages = Message::where('shop_id', $data)->get();
        return MessageResource::collection($messages);
    }
}
