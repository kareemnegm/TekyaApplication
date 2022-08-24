<?php

namespace App\Repositories\User;

use App\Http\Resources\User\CartProductResource;
use App\Http\Resources\User\UserCartResource;
use App\Interfaces\User\CartInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartInterface
{

    public function addProductsToCart($products, $cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $cart = $cart->product()->syncWithPivotValues($products['product_id'], ['quantity' => $products['quantity'], 'provider_shop_detail_id' => $products['shop_id']]);
    }

    public function IncreaseOrDecreaseProductQuantity($product)
    {

        $cart = Cart::findOrFail($product['cart_id']);
        if ($product['quantity'] == 0) {
            $cart = $cart->product()->detach($product['product_id']);
        } else {
            $cart = $cart->product()->syncWithPivotValues($product['product_id'], ['quantity' => $product['quantity']]);
        }
    }


    public function getCartProducts($cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        return UserCartResource::collection($cart->providerShopDetails()->distinct()->get());
    }
}
