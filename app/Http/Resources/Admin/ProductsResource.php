<?php

namespace App\Http\Resources\Admin;

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
        // dd($this->getFirstMedia('product_images')->getFullUrl());
        return [

            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_published' => $this->is_published,
            'to_donation' => $this->to_donation,

         
            'collection' => new CollectionResource($this->collection),

            'product_image' => $this->getFirstMedia('product_images') ? $this->getFirstMedia('product_images')->getFullUrl() : null,
            'order' => $this->order,
            'created_at' => $this->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('m-d-Y g:i A') : null,
            'updated_at' => $this->updated_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('m-d-Y g:i A') : null,
        ];
    }
}
