<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\ImageResource;
use App\Http\Resources\Provider\TagsResource;
use App\Http\Resources\Provider\VariantProductResource;
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

        return
            [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'offer_price' => $this->offer_price,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'stock_quantity' => $this->stock_quantity,
                'is_published' => $this->is_published,
                'to_donation' => $this->to_donation,
                'total_weight' => $this->total_weight,

                'variants' => json_decode($this->variants),

                'category' => [
                    'id' => $this->category->id,
                    'name' => $this->category->name
                ],
                'collection' => [
                    'id' => $this->collection->id,
                    'name' => $this->collection->name
                ],
                'tags' => $this->when(isset($this->tags),  TagsResource::collection($this->tags)),


                'product_images' => ImageResourceAdmin::collection($this->getMedia('product_images')) ?? null,
                'created_at' => $this->created_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('m-d-Y g:i A') : null,
                'updated_at' => $this->updated_at ? Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('m-d-Y g:i A') : null,
            ];
    }
}
