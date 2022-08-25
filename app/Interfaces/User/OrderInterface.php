<?php

namespace App\Interfaces\User;

interface OrderInterface
{

    /**
     * Undocumented function
     *
     * @param [type] $products
     * @param [type] $cart_id
     * @return void
     */
    public function orderReview($req);
    /**
     * Undocumented function
     *
     * @param [type] $product
     * @return void
     */
    public function placeOrder($req);
    

}
