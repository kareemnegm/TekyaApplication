<?php

namespace App\Http\Resources\User;

use App\Models\providerShopBranch;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopBracnhesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $brnach = providerShopBranch::findOrFail($this->id);
        return [
            'id' => $brnach->id,
            'name' => $brnach->name,
            'is_head' => $brnach->is_head,
            'is_active' => $brnach->is_active,
            'working_days' => json_decode($brnach->working_hours_day),
            'delivery' => $brnach->delivery,
            'pick_up' => $brnach->pick_up,
            'distance' => $this->distance > 1 ? round($this->distance, 1) . " K" : round($this->distance * 1000) . " M",

        ];
    }
}
