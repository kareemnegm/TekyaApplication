<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\PaymentResource;
use App\Http\Resources\User\PlaceOrderItemsResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderPlacedOrdersDetailsResource extends JsonResource
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
            'order_id'=>$this->order_id,
            'order_shop_id' => $this->id,
            "order_number" => $this->order->order_number,
            'delivery_time' => Carbon::parse($this->order->date_order_placed)->format('l M-Y g:i A'),
            'order_items' => new ProviderOrderItemResource($this),
            'coupon' => $this->invoice->coupon_id,
            'invoice_order' => new OrderInvoiceResource($this->invoice),
            'payment_method' => new PaymentResource($this->order->payment)
        ];
    }
}
