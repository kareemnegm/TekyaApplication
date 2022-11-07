<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserOrderAddressResource extends JsonResource
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
            'user_name'=>$this->user->first_name . ' ' .$this->user->last_name,
            're_name'=>$this->re_name,
            're_mobile'=>$this->re_mobile,
            'street'=>$this->street,
            'nearest_landmark'=>$this->nearest_landmark,
            'area'=>$this->area,
            'government'=>$this->government,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,

        ];
    }
}
