<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use App\Models\providerShopBranch;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        dd($this);
        $brnach = providerShopBranch::findOrFail($this->id);
        // $q = providerShopBranch::ByDistance($latitude, $longitude, array($request->shop_id))->first();

        return [
            'id' => $this->shop->id,
            'shop_name' => $this->shop->shop_name,
            'whatsapp_number' => $this->shop->whatsapp_number ? $this->shop->whatsapp_number : null,
            'facebook_link' => $this->shop->facebook_link ? $this->shop->facebook_link : null,
            'email' => $this->shop->instagram_link ? $this->shop->instagram_link : null,
            'email' => $this->shop->email ? $this->shop->email : null,
            'web_site' => $this->shop->web_site ? $this->shop->web_site : null,
            'shop_logo' => new ImageResource($this->shop->getFirstMedia('shop_logo')) ?? null,
            'shop_cover' => new ImageResource($this->shop->getFirstMedia('shop_cover')) ?? null,

            'delivery_time' => 30,

            'nearest_brnach' => [
                'id' => $brnach->id,
                'name' => $brnach->name,
                'working_hours_day' => json_decode($brnach->working_hours_day),
                'address' => $brnach->address,
                'distance' => $this->distance > 1 ? round($this->distance, 1) . " K" : round($this->distance * 1000) . " M",

            ],

        ];
    }
}
