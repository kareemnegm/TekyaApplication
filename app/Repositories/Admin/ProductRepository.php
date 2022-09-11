<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\ProductInterface;
use App\Interfaces\Admin\ProviderInterface;
use App\Models\Product;

class ProductRepository  implements ProductInterface
{

    /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAllAdminShopProduct($request, $collectionId)
    {


        $q = Product::query();

        $q->where('collection_id', $collectionId);

        if ($request->is_publish) {
            $is_publish = $request->is_publish === 'true' ? 1 : 0;
            $q->where('is_publish', $is_publish);
        }

        if (isset($request->sortBy) && !empty($request->sortBy)) {
            if ($request->sortBy == 'alphabetical') {
                $request->sortBy = 'name';
            } elseif ($request->sortBy == 'date_of_creating') {
                $request->sortBy = 'created_at';
            }
            if (isset($request->sort) && !empty($request->sort)) {
                $collections = $q->orderBy($request->sortBy, $request->sort)->get();
            } else {
                $collections = $q->orderBy($request->sortBy, 'desc')->get();
            }
        } else {
            $collections = $q->orderBy('order', 'ASC')->get();
        }


        return $collections;
    }

    /**
     * getAdminProductById function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAdminProductById($collectionID)
    {

        return Product::findOrFail($collectionID);
    }
    /**
     * deleteAdminShopProduct function
     *
     * @param [type] $projectId
     * @return void
     */
    public function deleteAdminShopProduct($projectIDs)
    {
        Product::destroy($projectIDs);
    }
    /**
     * Create Product  function
     *
     * @param [type] $projectId
     * @return void
     */
    public function createAdminShopProduct(array $productDetails)
    {

        $productDetails['shop_id'] = auth('provider')->user()->providerShopDetails->id;

        $product = Product::create($productDetails);
        $product->attachTags($productDetails['tags']);

        if (!empty($productDetails['product_images'])) {
            // foreach($productDetails['product_images'] as $productImage){
            $product->saveFiles($productDetails['product_images'], 'product_images');
        }
        return $product;
    }
    /**
     * updateAdminShopProduct function
     *
     * @param [type] $projectId
     * @return void
     */
    public function updateAdminShopProduct($collectionID, array $newDetails)
    {

        $product = Product::findOrFail($collectionID);

        $newDetails['shop_id'] = auth('provider')->user()->providerShopDetails->id;

        $product->update($newDetails);

        $product->syncTags($newDetails['tags']);

        if (!empty($newDetails['product_images'])) {
            foreach ($newDetails['product_images'] as $productImage) {
                $product->saveFiles($productImage, 'product_images');
            }
        }


        return $product;
    }


    /**
     * removeAdminProductCollection function
     *
     * @param [type] $products
     * @return void
     */
    public function adminRemoveProductCollection($products)
    {
        $products = Product::whereIn('id', $products)->delete();
    }

    /**
     * moveAdminProductFromCollection function
     *
     * @param [type] $products
     * @param [type] $collection_id
     * @return void
     */
    public function moveAdminProductFromCollection($products, $collection_id)
    {
        $products = Product::whereIn('id', $products)->update(['collection_id' => $collection_id]);
        return $products;
    }

    /**
     * publishAdminProduct function
     *
     * @param [type] $productDetails
     * @return void
     */
    public function publishAdminProduct($productDetails)
    {
        $products = Product::where('id', $productDetails['product_id'])->update(['is_published' => $productDetails['is_published']]);
    }
    
}
