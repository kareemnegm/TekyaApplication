<?php

namespace App\Http\Resources;

use App\Http\Resources\User\NearestBranchResource;
use App\Models\Area;
use App\Models\providerShopBranch;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopCategoryResource extends JsonResource
{
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

        $brnach = providerShopBranch::NearestBranch($latitude, $longitude,$this->id)->first();


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
            'nearest_brnach'=> isset($brnach) ? New NearestBranchResource($brnach) :null,
        
            ];
    }
}
