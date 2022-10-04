<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return[


            "address"=>  new UserOrderAddressResource($this->address),
            "order_user_status"=> $this->order_user_status,
            "order_shop_status"=> $this->order_shop_status,
        ];
    }
}
