<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
        'id' => $this->id,
        'shop_name' => $this->shop_name,
        'shop_logo'=>new ImageResource($this->getFirstMedia('shop_logo'))?? null,
        'shop_cover'=>new ImageResource($this->getFirstMedia('shop_cover'))?? null,
       ];
    }
}
