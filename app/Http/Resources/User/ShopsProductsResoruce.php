<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopsProductsResoruce extends JsonResource
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
        'id' => $this->shop->id,
        'shop_name' => $this->shop->shop_name,
        'shop_logo'=>new ImageResource($this->shop->getFirstMedia('shop_logo'))?? null,
        'shop_cover'=>new ImageResource($this->shop->getFirstMedia('shop_cover'))?? null,
        'shop_products'=>ProductsResource::collection($this->shop->products()->orderBy('order','ASC')->take(5)->get())?? null

       ];
    }
}
