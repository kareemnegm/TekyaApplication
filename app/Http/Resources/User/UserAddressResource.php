<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
            'address'=>$this->address,
            'address_details'=>$this->address_details,
            're_name'=>$this->re_name,
            're_mobile'=>$this->re_mobile,
            'street'=>$this->street,
            'nearest_landmark'=>$this->nearest_landmark,
            'notes'=>$this->notes,
            'area_id'=>$this->area_id,
            'government_id'=>$this->government_id,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'is_default'=>$this->is_default,
        ];
    }
}
