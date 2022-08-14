<?php

namespace App\Http\Resources;

use App\Models\Government;
use Illuminate\Http\Resources\Json\JsonResource;

class AreaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $government=Government::where('id',$this->government_id)->value('name');
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'government_id'=>$this->government_id,
            'government_name'=>$government,
        ];
    }
}
