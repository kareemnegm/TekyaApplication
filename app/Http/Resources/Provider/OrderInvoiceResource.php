<?php

namespace App\Http\Resources\Provider;

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
            "tekya_wallet"=> 0,
            "tekya_points"=> 0,
            "shipment_fees"=> $this->shipment_fees,
            "taxes"=> $this->taxes,
            "grand_total_price"=> $this->total_product_price+$this->shipment_fees+$this->taxes,
        ];
    }
}
