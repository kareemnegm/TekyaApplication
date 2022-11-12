<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class NearestBranchResource extends JsonResource
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
            'id' => $this->id ,
            'name' =>  $this->name,
            'working_hours_day' =>  json_decode($this->working_hours_day),
            'distance' =>  $this->distance > 1 ? round($this->distance, 1) . " K" : round($this->distance * 1000) . " M",
        
        ];
    }
}
