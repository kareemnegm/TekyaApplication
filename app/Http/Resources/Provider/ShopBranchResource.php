<?php

namespace App\Http\Resources\Provider;

use App\Models\Government;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopBranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $address = $this->BranchAddress()->value('address');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_head' => $this->is_head,
            'is_active' => $this->is_active,
            'address' => $address,
            'working_days' => ($this->working_hours_day),
        ];
    }
}
