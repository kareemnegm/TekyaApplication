<?php

namespace App\Http\Resources\User;

use App\Http\Resources\DeliveryOptionResource;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceOrderItemsResource extends JsonResource
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

        
            "delivery_option"=>$this->deliveryOption,

            'delivery_option'=> new DeliveryOptionResource($this->deliveryOption),
            // 'branch'=> $this->when(isset($this->branch_id),new UserBranchOrderResource(providerShopBranch::find($this->branch_id))),
            // 'address'=> $this->when(isset($this->address_id),new UserOrderAddressResource(UserAddress::find($this->address_id))),

            
            "invoice_shop"=> new OrderInvoiceResource($this->invoice),

            "shop"=>[
                'id'=>$this->shop->id,
                'name'=>$this->shop->name,
                'shop_logo' => new ImageResource($this->shop->getFirstMedia('shop_logo')) ?? null,
                'shop_cover' => new ImageResource($this->shop->getFirstMedia('shop_cover')) ?? null,
                'shop_shipping_fees'=>30,
                'products' => ShopItemsOrderResource::collection($this->orderItems),

            ],


        ];
    }
}
