<?php

namespace App\Http\Resources\User;

use App\Http\Resources\DeliveryOptionResource;
use App\Http\Resources\ImageResource;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\DeliveryOption;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;
use App\Models\UserAddress;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OrderReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $cart_id = Auth::user()->cart->id;
        $cart  = Cart::findOrFail($cart_id);

        $cartProducts = CartProduct::with(['product'])->where('cart_id', $cart_id)->where('provider_shop_details_id',$this->id)->get();

        $toalPrice=$cartProducts->sum(function ($product) {
            return $product->product->order_price*$product->quantity;
        });

        return [
            'id' => $this->id,
            'shop_name' => $this->shop_name,
            'shop_logo' => new ImageResource($this->getFirstMedia('shop_logo')) ?? null,
            'shop_cover' => new ImageResource($this->getFirstMedia('shop_cover')) ?? null,
            'total_products'=>$this->productsCarts()->where('cart_id',$cart->id)->count(),
            'total_price'=>$toalPrice,
            'shop_taxes'=>$this->vat ? 0 : round(($toalPrice*14/100),2),
            'shop_shipping_fees'=>30,
            'products' => CartProductResource::collection($this->productsCarts()->where('cart_id',$cart->id)->get()),
            'delivery_option_id'=> new DeliveryOptionResource(DeliveryOption::findOrFail($this->delivery_option_id)),
            'branch'=> $this->when(isset($this->branch_id),new UserBranchOrderResource(providerShopBranch::find($this->branch_id))),
            'address'=> $this->when(isset($this->address_id),new UserOrderAddressResource(UserAddress::find($this->address_id))),

        ];
    }
}
