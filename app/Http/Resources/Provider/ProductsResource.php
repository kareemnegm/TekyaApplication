<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\ImageResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'id'=>$this->id,

            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'over_price'=>$this->over_price,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'stock_quantity'=>$this->stock_quantity,
            'is_published'=>$this->is_published,
            'to_donation'=>$this->to_donation,

            'variant'=>$this->when(!is_null($this->variant_id), $this->variant),

            'category'=>[
                'id'=>$this->category->id,
                'name'=>$this->category->name
            ],
            'collection'=>[
                'id'=>$this->collection->id,
                'name'=>$this->collection->name
            ],

            'product_images'=> ImageResource::collection($this->getMedia()),
            'created_at'=> $this->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('m-d-Y g:i A'):null,
            'updated_at'=>$this->updated_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('m-d-Y g:i A'):null,

        ];
    }
}
