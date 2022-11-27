<?php

namespace App\Http\Resources\provider;

use Illuminate\Http\Resources\Json\JsonResource;

class openingTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'opening_time' => json_decode($this->working_hours_day),

        ];
    }
}
