<?php

namespace App\Http\Resources\Admin\ProviderShop;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopDetailsSimple extends JsonResource
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
        ];
    }
}
