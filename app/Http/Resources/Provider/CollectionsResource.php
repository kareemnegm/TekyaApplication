<?php

namespace App\Http\Resources\Provider;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionsResource extends JsonResource
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
            'is_published'=>$this->is_published,
            'collection_image' => $this->getFirstMediaUrl('collection_image','thumb'),
        ];
    }
}
