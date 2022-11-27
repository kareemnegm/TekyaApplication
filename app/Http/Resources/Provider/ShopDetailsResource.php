<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\GovernmentResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\SingleAreaResource;
use App\Models\Area;
use App\Models\Government;
use App\Models\providerShopBranch;
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

        $branch = providerShopBranch::where('shop_id', $this->id)->first();
        $area = Area::where('id', $branch->area_id)->first();
        $government = Government::where('id', $branch->government_id)->first();
        return [
            'id' => $this->id,
            'shop_name' => $this->shop_name,
            'whatsapp_number' => $this->whatsapp_number ? $this->whatsapp_number : null,
            'facebook_link' => $this->facebook_link ? $this->facebook_link : null,
            'instagram_link' => $this->instagram_link ? $this->instagram_link : null,
            'email' => $this->instagram_link ? $this->instagram_link : null,
            'email' => $this->email ? $this->email : null,
            'web_site' => $this->web_site ? $this->web_site : null,
            'shop_logo' => new ImageResource($this->getFirstMedia('shop_logo')) ?? null,
            'shop_cover' => new ImageResource($this->getFirstMedia('shop_cover')) ?? null,
            'category' =>  CategoryResource::collection($this->category),
            'address' => $branch->address,
            'street' => $branch->street,
            'address_details' => $branch->address_details,
            'nearest_landmark' => $branch->nearest_landmark,
            'notes' => $branch->notes,
            'delivery' => $branch->delivery,
            'pick_up' => $branch->pick_up,
            'area' => new SingleAreaResource($area) ? new SingleAreaResource($area) : null,
            'government' => new GovernmentResource($government) ? new GovernmentResource($government) : null,
            'working_days' => json_decode($branch->working_hours_day),
            'payment' => PaymentResource::collection($branch->paymentOption),
        ];
    }
}
