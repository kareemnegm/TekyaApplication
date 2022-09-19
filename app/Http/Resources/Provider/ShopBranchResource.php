<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\GovernmentResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\SingleAreaResource;
use App\Models\Area;
use App\Models\Government;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopBranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $area = Area::where('id', $this->area_id)->first();
        $government = Government::where('id', $this->government_id)->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_head' => $this->is_head,
            'is_active' => $this->is_active,
            'address' => $this->address,
            'street' => $this->street,
            'address_details' => $this->address_details,
            'nearest_landmark' => $this->nearest_landmark,
            'notes' => $this->notes,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'area' => new SingleAreaResource($area)?new SingleAreaResource($area):null,
            'government' => new GovernmentResource($government)?new GovernmentResource($government):null,
            'longitude' => $this->longitude,
            'working_days' => json_decode($this->working_hours_day),


        ];
    }
}
