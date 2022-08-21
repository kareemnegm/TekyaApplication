<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\ImageResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BundelResource extends JsonResource
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
            'is_pickup'=>$this->is_pickup,
            'is_delivery'=>$this->is_delivery,

            'category'=>[
                'id'=>$this->category->id,
                'name'=>$this->category->name
            ],
        
            'products'=>ProductsResource::collection($this->products) ?? NULL,

            'tags'=>$this->when(isset($this->tags),  TagsResource::collection($this->tags)),

        
            'bundel_images'=> ImageResource::collection($this->getMedia('bundel_images'))?? null,
            'created_at'=> $this->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('m-d-Y g:i A'):null,
            'updated_at'=>$this->updated_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('m-d-Y g:i A'):null,


        ];
    }
}
