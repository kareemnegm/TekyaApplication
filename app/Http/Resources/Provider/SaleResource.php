<?php

namespace App\Http\Resources\Provider;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        dd($this->id);
        $category = Category::where('id', $this->category_id)->value('name');
        return [
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'discount_cap' => $this->discount_cap,
            'discount' => $this->discount . '%',
            'price_range_start' => $this->price_range_start,
            'price_range_end' => $this->price_range_end,
            'category_id' => $this->category_id,
            'category_name' => $category,
        ];
    }
}
