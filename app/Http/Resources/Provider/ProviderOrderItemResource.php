<?php

namespace App\Http\Resources\Provider;

use App\Http\Resources\DeliveryOptionResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\User\DeliveryShipmentResource;
use App\Http\Resources\User\PickupResource;
use App\Http\Resources\User\ShopInvoiceResource;
use App\Http\Resources\User\ShopItemsOrderResource;
use App\Models\OrderPickup;
use App\Models\OrderShipment;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderOrderItemResource extends JsonResource
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
            'id' => $this->shop->id,
            'name' => $this->shop->shop_name,
            'total_products' => $this->total_items,
            'shop_logo' => new ImageResource($this->shop->getFirstMedia('shop_logo')) ?? null,
            'shop_cover' => new ImageResource($this->shop->getFirstMedia('shop_cover')) ?? null,
            'shop_shipping_fees' => 30,
            'products' => ShopItemOrderResource::collection($this->orderItems),

            'delivery_option' => new DeliveryOptionResource($this->deliveryOption),

            'delivery_type_info' => $this->when($this->deliveryType, function () {

                if ($this->resource->deliveryType instanceof OrderShipment) {
                    return new DeliveryShipmentResource($this->resource->deliveryType);
                }

                if ($this->resource->deliveryType instanceof OrderPickup) {
                    return new PickupResource($this->resource->deliveryType);
                }
            }),




        ];
    }
}
