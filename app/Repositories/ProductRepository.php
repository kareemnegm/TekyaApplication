<?php

namespace App\Repositories;

use App\Interfaces\CollectionInterface;
use App\Interfaces\ProductInterface;
use App\Models\Collection;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;

class ProductRepository implements ProductInterface
{

    /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAllShopProduct($request,$collectionId){

        $limit=$request->limit ?$request->limit:10;

        $q = Product::query();

        $q->where('collection_id',$collectionId);

            if ($request->is_publish) {
                $is_publish = $request->is_publish === 'true'? 1: 0;
                $q->where('is_publish',$is_publish);
            }

            if ($request->page) {
                $collections = $q->orderBy('order','ASC')->paginate($limit);
            } else {
                $collections = $q->orderBy('order','ASC')->get();
            }

        return $collections;
    }

    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getProductById($collectionID){

        return Product::findOrFail($collectionID);

    }
    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function deleteShopProduct($projectID){

        Product::destroy($projectID);
    }
    /**
     * Create Product  function
     *
     * @param [type] $projectId
     * @return void
     */
    public function createShopProduct(array $productDetails){


        $product=Product::create($productDetails);
        $product->attachTags($productDetails['tags']);

        if (!empty($productDetails['product_images'])) {
            // foreach($productDetails['product_images'] as $productImage){
            $product->saveFiles($productDetails['product_images'],'product_images');
         


        }
        return $product;

    }
    /**
     * Product Update function
     *
     * @param [type] $projectId
     * @return void
     */
    public function updateShopProduct($collectionID, array $newDetails){

        $product= Product::findOrFail($collectionID);
        $product->update($newDetails);
        
        $product->syncTags($newDetails['tags']);

        if (!empty($newDetails['product_images'])) {
            foreach($newDetails['product_images'] as $productImage){
            $product->saveFiles($productImage,'product_images');
         }
        }


        return $product;

    }


    

}
