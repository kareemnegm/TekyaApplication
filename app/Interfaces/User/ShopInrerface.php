<?php

namespace App\Interfaces\User;

interface ShopInrerface
{

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
    public function getProductsShop($request);

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function getShopDetails($request);

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function getShopBranches($request);

     /**
     * Related Shops function
     *
     * @param [type] $request
     * @return void
     */
    public function relatedShops($request,$productId);


    /**
     * Related Shops function
     *
     * @param [type] $request
     * @return void
     */
    public function getShopCollections($shop_id);


    


    


}
