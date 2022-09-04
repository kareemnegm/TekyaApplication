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
        $area=Area::find($this->area_id);
        $government=Government::find($this->government_id);
        $shop_branch=providerShopBranch::find($this->shop_branch_id);
        return[
            'id'=>$this->id,
            'area'=>new DeliveryAreaResource($area),
            'government'=>new GovernmentResource($government),
            'branch'=>new DeliveryBranchResource($shop_branch),
            'delivery_fees'=>$this->delivery_fees,
            'delivery_estimated_time'=>$this->delivery_estimated_time,
            'opening_times'=>json_decode($this->delivery_date_time)

        ];
    }
}
