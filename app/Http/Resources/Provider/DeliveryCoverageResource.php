<?php

namespace App\Http\Resources\Provider;

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
            'area'=>$this->area_id,
            'government'=>$this->government_id,
            'branch'=>$this->shop_branch_id,
            'opening_times'=>$this->delivery_date_time,
            'delivery_fees'=>$this->delivery_fees,
            'delivery_estimated_time'=>$this->delivery_estimated_time,
        ];
    }
}
