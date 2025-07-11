<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class PickupResource extends JsonResource
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
            "address"=>  new UserBranchOrderResource($this->address),
            "order_user_status"=> $this->order_user_status,
            "order_shop_status"=> $this->order_shop_status,
        ];
    }
}
