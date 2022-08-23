<?php

namespace App\Interfaces\User;

interface CartInterface
{

    public function addProductsToCart($products,$cart_id);
    public function IncreaseOrDecreaseProductQuantity($product);
    public function getCartProducts($cart_id);

}
