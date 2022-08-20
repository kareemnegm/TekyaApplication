<?php

namespace App\Interfaces;

interface ProductInterface{

   /**
     * All Shop Procuts function
     *
     * @return void
     */
    public function getAllShopProduct($request,$collectionId);
    /**
     * Single Product Shop function
     *
     * @param [type] $ProductID
     * @return void
     */
    public function getProductById($ProductID);
   
    /**
     * Create Product Shop function
     *
     * @param array $centerDetails
     * @return void
     */
    public function createShopProduct(array $Product);
    /**
     * Updated Product Shop function
     *
     * @param [type] $ProductID
     * @param array $newDetails
     * @return void
     */
    public function updateShopProduct($ProductID, array $newDetails);

    /**
     * Updated Product Shop function
     *
     * @param [type] $ProductID
     * @param array $newDetails
     * @return void
     */
    public function deleteShopProduct($ProductID);

}
