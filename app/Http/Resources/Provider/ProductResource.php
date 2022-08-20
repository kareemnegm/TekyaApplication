<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'over_price'=>$this->over_price,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'stock_quantity'=>$this->stock_quantity,
            'is_published'=>$this->is_published,
            'to_donation'=>$this->to_donation,
            'variant_id'=>$this->variant_id,
            'collection_id'=>$this->collection_id,
            'category_id'=>$this->category_id,
            'product_images'=> ImageResource::collection($this->getMedia())


        ];
    }
}
