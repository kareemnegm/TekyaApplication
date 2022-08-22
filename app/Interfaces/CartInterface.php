<?php

namespace App\Interfaces;

interface CartInterface
{

    public function addProductsToCart($products,$cart_id);
    public function IncreaseOrDecreaseProductQuantity($product);

}
