<?php

namespace App\Interfaces\Admin;

interface ProductInterface
{

    /**
     * All Shop Procuts function
     *
     * @return void
     */
    public function getAllAdminShopProduct($request, $collectionId);
    /**
     * Single Product Shop function
     *
     * @param [type] $ProductID
     * @return void
     */
    public function getAdminProductById($ProductID);

    /**
     * Create Product Shop function
     *
     * @param array $centerDetails
     * @return void
     */
    public function createAdminShopProduct(array $Product);
    /**
     * Updated Product Shop function
     *
     * @param [type] $ProductID
     * @param array $newDetails
     * @return void
     */
    public function updateAdminShopProduct($ProductID, array $newDetails);

    /**
     * Updated Product Shop function
     *
     * @param [type] $ProductID
     * @param array $newDetails
     * @return void
     */
    public function deleteAdminShopProduct($ProductIDs);
    /**
     * Remove Product From Collection function
     *
     * @param [type] $products
     * @return void
     */
    public function adminRemoveProductCollection($products);
    /**
     * Move Porduct To Aother Collection function
     *
     * @param [type] $products
     * @param [type] $collection_id
     * @return void
     */
    public function moveAdminProductFromCollection($products, $collection_id);
    /**
     * Publish And Un Published Product function
     *
     * @param [type] $productDetails
     * @return void
     */
    public function publishAdminProduct($productDetails);

}
