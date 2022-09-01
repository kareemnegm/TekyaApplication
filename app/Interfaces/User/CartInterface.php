<?php

namespace App\Interfaces\User;

interface CartInterface
{

    public function addProductsToCart($req);
    public function IncreaseOrDecreaseProductQuantity($req);
    public function getCartProducts();

}
