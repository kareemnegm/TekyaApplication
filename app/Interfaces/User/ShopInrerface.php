<?php

namespace App\Interfaces\User;

interface ShopInrerface {

    /**
     * Undocumented function
     *
     * @return void
     */
    public function nearestShops($request);

    /**
     * Undocumented function
     *
     * @return void
     */
    public function newShops($request);

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function shopsProducts($request);

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function getProductsShop($request,$shopID);

      /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function getShopDetails($request,$shopID);

         /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function getShopBranches($request,$shopID);

    
    
    

    
}
