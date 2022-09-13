<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserCartResource extends JsonResource
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
 
        return [
            'id' => $this->id,
            'shop_name' => $this->shop_name,
            'shop_logo' => new ImageResource($this->getFirstMedia('shop_logo')) ?? null,
            'shop_cover' => new ImageResource($this->getFirstMedia('shop_cover')) ?? null,
            'total_products'=>$this->productsCarts()->where('cart_id',$cart->id)->count(),
            'total_price'=>$this->productsCarts->sum('price'),
            'products' => CartProductResource::collection($this->productsCarts()->where('cart_id',$cart->id)->get())

        ];
    }
}
