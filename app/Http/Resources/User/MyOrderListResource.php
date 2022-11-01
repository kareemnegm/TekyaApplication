<?php

namespace App\Http\Resources\User;

use App\Http\Resources\PaymentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MyOrderListResource extends JsonResource
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
            "id" => $this->id,
            "order_number" => $this->order_number,
            "total_products" => $this->total_items,
            "total_shop" => $this->total_shop,
            "date_order_placed" => $this->date_order_placed,
            "total_items" => $this->order_items_sum_quantity,
            "payment" => new PaymentResource($this->payment),

            "invoice_info" => [
                "grand_total_price" => $this->invoice->grand_total_price,
                "status" => $this->invoice->status,

            ]

        ];
    }
}
