<?php

namespace App\Http\Resources\Provider;

use App\Models\Government;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopDetailsResource extends JsonResource
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
            'whatsapp_number' => $this->whatsapp_number?$this->whatsapp_number:null,
            'facebook_link' => $this->facebook_link?$this->facebook_link:null,
            'email' => $this->instagram_link?$this->instagram_link:null,
            'email' => $this->email?$this->email:null,
            'web_site' => $this->web_site?$this->web_site:null,
        ];
    }
}
