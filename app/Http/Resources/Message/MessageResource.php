<?php

namespace App\Http\Resources\Message;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = Carbon::parse($this->created_at);
        $isToday = $date->isToday();
        $isYesterday = $date->isYesterday();

        if ($isToday) {
            $day = 'Today';
        } elseif ($isYesterday) {
            $day = 'Yesterday';
        } else {
            $day = $date->format('l M-Y');
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'date' => $date->format('h:m A, d M Y'),
            'day' => $day
        ];
    }
}
