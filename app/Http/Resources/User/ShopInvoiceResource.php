<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopInvoiceResource extends JsonResource
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
            "shop_invoice_number"=> $this->shop_invoice_number,
            "coupon_id"=> $this->coupon_id,
            "status"=> $this->status,
            "discount"=> $this->discount,
            "shipment_fees"=> $this->shipment_fees,
            "total_product_price"=> $this->total_product_price,
            "total_invoice"=> $this->total_invoice,
            "invoice_date"=> $this->invoice_date,
        ];
    }
}
