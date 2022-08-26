<?php

namespace App\Repositories;

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
    }
}
