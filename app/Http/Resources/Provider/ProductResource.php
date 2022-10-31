<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\ImageResource;
use App\Http\Resources\provider\ProductCollectionResource;
use Carbon\Carbon;
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
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'offer_price'=>$this->offer_price,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'stock_quantity'=>$this->stock_quantity,
            'is_published'=>$this->is_published,
            'to_donation'=>$this->to_donation,

            'variant' => VariantResource::collection($this->variant),

            'category'=>[
                'id'=>$this->category->id,
                'name'=>$this->category->name
            ],

            'shop_details'=>[
                'id'=>$this->shop->id,
                'shop_name'=>$this->shop->shop_name,
                'whatsapp_number'=>$this->shop->whatsapp_number,
                'facebook_link'=>$this->shop->facebook_link,
                'available_vat'=>$this->shop->vat,
                'email'=>$this->shop->email,
            ],

            'collection' => $this->when($this->collection, new ProductCollectionResource($this->collection)),

            'tags'=>TagsResource::collection($this->tags),
            
            'product_images'=> ImageResource::collection($this->getMedia('product_images')),

            'created_at'=> $this->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('m-d-Y g:i A'):null,
            'updated_at'=>$this->updated_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('m-d-Y g:i A'):null,


        ];
    }
}
