<?php

namespace App\Interfaces\User;

interface CartInterface
{

    /**
     * Undocumented function
     *
     * @param [type] $req
     * @return void
     */
    public function addProductsToCart($req);
    /**
     * Undocumented function
     *
     * @param [type] $req
     * @return void
     */
    public function IncreaseOrDecreaseProductQuantity($req);
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCartProducts();
    /**
     * Undocumented function
     *
     * @param [type] $req
     * @return void
     */
    public function clearShopsFromCarts($req);
    /**
     * Undocumented function
     *
     * @param [type] $itmes
     * @return void
     */
    public function addMultiProductsToCarts($itmes);
    /**
     * Undocumented function
     *
     * @param [type] $itmes
     * @return void
     */
    public function cartItemsCount();
    
}
              