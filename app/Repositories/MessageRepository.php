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
        $limit = $data['limit'] ? $data['limit'] : 10;
        $messages = Message::where('shop_id', $data['shop_id'])->paginate($limit);
        return MessageResource::collection($messages);
    }
}
