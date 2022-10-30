<?php

namespace App\Repositories;

use App\Interfaces\CollectionInterface;
use App\Models\Collection;

class CollectionRepository implements CollectionInterface
{

    /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAllShopCollection($request)
    {

        // $limit = $request->limit ? $request->limit : 10;

        $q = Collection::query();

        $shopId = auth('provider')->user()->providerShopDetails->id;
        $q->where('shop_id', $shopId);


        if ($request->is_publish) {
            $is_publish = $request->is_publish === 'true' ? 1 : 0;
            $q->where('is_publish', $is_publish);
        }


        // if ($request->page) {
        //     $collections = $q->paginate($limit);
        // } else {
            $collections = $q->get();
        // }

        return $collections;
    }

    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getCollectionById($collectionID)
    {

        return Collection::findOrFail($collectionID);
    }
    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function deleteShopCollection($collectionID)
    {

        Collection::destroy($collectionID);
    }
    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function createShopCollection(array $collectionDetails)
    {

        $collectionDetails['shop_id'] = auth('provider')->user()->providerShopDetails->id;

        $collection = Collection::create($collectionDetails);

        if (isset($collectionDetails['collection_image'])) {
            $collection->saveFiles($collectionDetails['collection_image'], 'collection_image');
        }

        $collection['collection_image'] = $collection->getFirstMediaUrl('collection_image', 'thumb');

        return $collection;
    }
    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function updateShopCollection($collectionID, array $newDetails)
    {

        $collection = Collection::findOrFail($collectionID);
        $collection->update($newDetails);
        if (isset($newDetails['collection_image'])) {
            $collection->updateFile($newDetails['collection_image'], 'collection_image');
        }
        $collection['collection_image'] = $collection->getFirstMediaUrl('collection_image', 'thumb');
        return $collection;
    }

    public function rename($details)
    {
        $collection = Collection::findOrFail($details['collection_id']);
        $collection->update(['name' => $details['name']]);
        return $collection;
    }



    public function publish_unPublish($details){
        $collection = Collection::findOrFail($details['collection_id']);
        $collection->update(['is_published' => $details['published']]);
        return $collection;

    }

}
