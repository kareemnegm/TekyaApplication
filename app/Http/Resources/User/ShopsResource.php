<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopsResource extends JsonResource
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
            'id' => $this->shop->id,
            'shop_name' => $this->shop->shop_name,

            'distance' => $this->distance > 1 ? round($this->distance,1) ." K": round($this->distance *1000)." M",
            'delivery_time' => 30,
            'nearest_brnach' =>[
                'id' =>$this->id,
                'name' =>$this->name,
                'latitude'=>$this->latitude,
                'longitude'=>$this->longitude,
            ],

            'shop_logo'=>new ImageResource($this->shop->getFirstMedia('shop_logo'))?? null,
            'shop_cover'=>new ImageResource($this->shop->getFirstMedia('shop_cover'))?? null,

           ];
    }
}
