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

        if(isset($request->category_id)){
            $products=$this->shop->products()->where('category_id',$request->category_id)->orderBy('order','ASC')->take(5)->get();

        }else{
            $products=$this->shop->products()->orderBy('order','ASC')->take(5)->get();
        }

       return [
        'id' => $this->shop->id,
        'shop_name' => $this->shop->shop_name,  
        'shop_logo'=>new ImageResource($this->shop->getFirstMedia('shop_logo'))?? null,
        'shop_cover'=>new ImageResource($this->shop->getFirstMedia('shop_cover'))?? null,

        'distance' => $this->distance > 1 ? round($this->distance,1) ." K": round($this->distance *1000)." M",
        'delivery_time' => 30,

        'nearest_brnach' =>[
            'id' =>$this->id,
            'name' =>$this->name,
        ],

        'shop_products'=>ProductsResource::collection($products)?? null

       ];
    }
}
