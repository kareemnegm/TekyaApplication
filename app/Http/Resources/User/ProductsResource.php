<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use App\Models\CartProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $inCart=null;
        $cartProductQuantity=null;
        if (\Request::header('Authorization')) {
            $cart_id = auth('user')->user()->cart->id;
            $inCart = CartProduct::where('product_id', $this->id)->where('cart_id', $cart_id)->where('provider_shop_details_id', $this->shop_id)->exists();
            if ($inCart) {
                $cartProductQuantity = CartProduct::where('product_id', $this->id)->where('cart_id', $cart_id)->where('provider_shop_details_id', $this->shop_id)->value('quantity');
            }
        }

        return [

            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'over_price' => $this->over_price,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'stock_quantity' => $this->stock_quantity,
            'to_donation' => $this->to_donation,
            'order' => $this->order,
            'shop' => [
                'id' => $this->shop->id,
                'name' => $this->shop->shop_name,

            ],
            'in_cart' => $inCart?$inCart:false,
            'quantity' => isset($cartProductQuantity) ? $cartProductQuantity : null,

            'product_image' => new ImageResource($this->getFirstMedia('product_images')) ?? null,
        ];
    }
}
