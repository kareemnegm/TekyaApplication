<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderInvoiceResource extends JsonResource
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

            "id"=> $this->id,
            "total_product_price"=> $this->total_product_price,
            "tekya_wallet"=> $this->tekya_wallet,
            "tekya_points"=> $this->tekya_points,
            "shipping_fees"=> $this->shipping_fees,
            "taxes"=> $this->taxes,
            "grand_total_price"=> $this->grand_total_price,
      
        ];
    }
}
