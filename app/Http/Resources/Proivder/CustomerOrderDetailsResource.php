<?php

namespace App\Http\Resources\Proivder;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderDetailsResource extends JsonResource
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
            'order_id' => $this->order_id,
            'order_shop_id' => $this->id,
            'order_number' => $this->invoice->shop_invoice_number,
            'status' => $this->invoice->status,
            'delivery_option' => $this->deliveryOption->name,
            'total' => $this->invoice->total_invoice,
            'total_products' => $this->total_items,
            'total_product_items' => $this->order_items_sum_quantity,
            'order_status'=>isset($this->order->date_order_placed)?'placed':null
        ];
    }
}
