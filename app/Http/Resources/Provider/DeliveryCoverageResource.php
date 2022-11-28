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

            'shop'=>[
                'id'=>$this->shop->id,
                'name'=>$this->shop->shop_name,
            ],
            'government'=>[
                'id'=>$this->government->id,
                'name'=>$this->government->name,
            ],
            'area'=>[
                'id'=>$this->area->id,
                'name'=>$this->area->name,
            ],

            'delivery_fees'=>$this->delivery_fees,
            'delivery_estimated_time'=>$this->delivery_estimated_time,
            'notes'=>$this->notes,

        ];
    }
}
