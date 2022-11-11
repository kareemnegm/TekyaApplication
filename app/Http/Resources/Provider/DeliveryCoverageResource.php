<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\GovernmentResource;
use App\Models\Area;
use App\Models\Government;
use App\Models\providerShopBranch;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryCoverageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return[
            'id'=>$this->id,
            'shop_id'=>$this->shop_id,
            'delivery_fees'=>$this->delivery_fees,
            'average_delivery_time'=>$this->average_delivery_time,

        ];
    }
}
