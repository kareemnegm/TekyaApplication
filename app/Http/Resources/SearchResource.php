<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_name' => $this->when(isset($this->name), $this->name),
            'shop_name' => $this->when(isset($this->shop_name), $this->shop_name),

        ];
    }
}
