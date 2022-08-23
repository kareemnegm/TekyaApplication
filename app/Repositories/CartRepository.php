<?php

namespace App\Repositories;

use App\Interfaces\CartInterface;
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

        if ($product['quantity'] == 0) {
            DB::table('cart_product')->where('cart_id', $product['cart_id'])->where('product_id', $product['product_id'])->delete();
        } else {
            DB::table('cart_product')->where('cart_id', $product['cart_id'])->where('product_id', $product['product_id'])->update(['quantity' => $product['quantity']]);
            
        }
    }
}
