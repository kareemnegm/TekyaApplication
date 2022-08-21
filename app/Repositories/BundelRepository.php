<?php

namespace App\Repositories;

use App\Interfaces\BundelInterface;
use App\Interfaces\CollectionInterface;
use App\Interfaces\ProductInterface;
use App\Models\Bundel;
use App\Models\Collection;
use App\Models\Product;
use GuzzleHttp\Psr7\Request;

class BundelRepository implements BundelInterface
{

    /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAllShopBundel($request){

        $limit=$request->limit ?$request->limit:10;

        $q = Bundel::query();

        $shopId=auth('provider')->user()->providerShopDetails->id;
         $q->where('shop_id',$shopId);

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
    public function getBundelById($collectionID,$request){

        return Bundel::findOrFail($collectionID);

    }
    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function deleteShopBundel($projectID){

        Bundel::destroy($projectID);
    }
    /**
     * Create Product  function
     *
     * @param [type] $projectId
     * @return void
     */
    public function createShopBundel(array $bundelDetails){


        $product=Bundel::create($bundelDetails);

        if (!empty($bundelDetails['tags'])) {
            $product->attachTags($bundelDetails['tags']);
        }


        if (!empty($bundelDetails['products_ids'])) {
            $product->products()->attach($bundelDetails['products_ids']);
        }

        if (!empty($bundelDetails['bundel_images'])) {
            $product->saveFiles($bundelDetails['bundel_images'],'bundel_images');
        }

        return $product;

    }
    /**
     * Product Update function
     *
     * @param [type] $projectId
     * @return void
     */
    public function updateShopBundel($bundelID, array $newDetails){

        $product= Bundel::findOrFail($bundelID);
        $product->update($newDetails);


        if (!empty($newDetails['products_ids'])) {
            $product->products()->sync($newDetails['products_ids']);
        }


        if (!empty($newDetails['tags'])) {
            $product->syncTags($newDetails['tags']);
        }

        if (!empty($newDetails['bundel_images'])) {
            $product->saveFiles($newDetails['bundel_images'],'bundel_images');
         
        }


        return $product;

    }


    

}
