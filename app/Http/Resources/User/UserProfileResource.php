<?php

namespace App\Http\Resources\User;

use App\Http\Resources\AreaResource;
use App\Http\Resources\GovernmentResource;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'mobile' => $this->country_code . $this->mobile,
            'government' => new GovernmentResource($this->government),
            'area' => new AreaResource($this->area),
            'user_image' => new ImageResource($this->getFirstMedia('user_images')) ?? null,

        ];
    }
}
