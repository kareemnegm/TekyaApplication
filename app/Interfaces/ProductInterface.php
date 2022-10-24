<?php

namespace App\Interfaces;

interface ProductInterface
{


     /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function productsSearch($request);
    /**
     * All Shop Procuts function
     *
     * @return void
     */
    public function getAllShopProduct($request);
 /**
     * All Shop Procuts function
     *
     * @return void
     */
    public function getAllShopCollectionProduct($request, $collectionId);

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
    public function deleteShopProduct($ProductIDs);



    public function remove_product_from_collection($products);



    public function move_product_from_collection($products, $collection_id);


    public function publishOrUnPublishProduct($productDetails);


    public function createProductVariant($variant);
    public function deleteVariantsFromProduct($variant_id);
    public function deleteVariantValue($value_id);
    public function getVariantsValues($variant_id);
    public function getProductVariants($productID);

   

    

}
