<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use App\Models\Area;
use App\Models\providerShopBranch;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopDetailsInSingelProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if (auth('user')->check()) {
            $userLocation = auth('user')->user()->userLocation;
            if ($userLocation) {
                $request['latitude'] = $userLocation->latitude;
                $request['longitude'] = $userLocation->longitude;
            }
        } elseif (isset($request->area_id) && !empty($request->area_id)) {
            $area = Area::findOrFail($request->area_id);
            $request['latitude'] = $area->latitude;
            $request['longitude'] = $area->longitude;
        }

        $latitude = $request->latitude ? $request->latitude : 30.012537910528884;
        $longitude = $request->longitude ? $request->longitude : 31.290307;

        $brnach = providerShopBranch::NearestBranch($latitude, $longitude,$this->id);

        return [
            'id' => $this->id,
            'shop_name' => $this->shop_name,
            'whatsapp_number' => $this->whatsapp_number ? $this->whatsapp_number : null,
            'facebook_link' => $this->facebook_link ? $this->facebook_link : null,
            'email' => $this->instagram_link ? $this->instagram_link : null,
            'email' => $this->email ? $this->email : null,
            'web_site' => $this->web_site ? $this->web_site : null,
            'shop_logo' => new ImageResource($this->getFirstMedia('shop_logo')) ?? null,
            'shop_cover' => new ImageResource($this->getFirstMedia('shop_cover')) ?? null,

            'delivery_time' => 30,

            'nearest_brnach' => [
                'id' => isset($brnach) ? $brnach->id :null,
                'name' => isset($brnach) ? $brnach->name:null,
                'working_hours_day' => isset($brnach) ? json_decode($brnach->working_hours_day):null,
                'distance' => isset($brnach) > 1 ? round($brnach->distance, 1) . " K" : round($brnach->distance * 1000) . " M",
            ],
            ];
    }
}
