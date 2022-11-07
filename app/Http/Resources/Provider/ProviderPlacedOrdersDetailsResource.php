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

            "order_number"=>$this->order->order_number,

            'order_items' => new ProviderOrderItemResource($this),
            'coupon'=>$this->invoice->coupon_id,
            'invoice_order' => New OrderInvoiceResource ($this->invoice),

            'payment_method'=>new PaymentResource($this->order->payment)
        ];
    }
}
