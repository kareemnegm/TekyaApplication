<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\CollectionInterface;
use App\Interfaces\Admin\ProviderInterface;
use App\Models\Collection;

class CollectionRepository  implements CollectionInterface
{

      /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAllAdminShopCollection($request)
    {

        // $limit = $request->limit ? $request->limit : 10;

        $q = Collection::query();


        if ($request->shop_id) {
            $q->where('shop_id', $request->shop_id);
        }

        if ($request->is_publish) {
            $is_publish = $request->is_publish === 'true' ? 1 : 0;
            $q->where('is_published', $is_publish);
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
    public function getAdminCollectionById($collectionID)
    {
        return Collection::findOrFail($collectionID);
    }
    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function deleteAdminShopCollection($collectionID)
    {

        Collection::destroy($collectionID);
    }
    /**
     * createAdminShopCollection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function createAdminShopCollection(array $collectionDetails)
    {

        $collectionDetails['admin_id'] = auth('admin')->user()->id;

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
    public function updateAdminShopCollection($collectionID, array $newDetails)
    {

        $collection = Collection::findOrFail($collectionID);
        $collection->update($newDetails);
        if (isset($newDetails['collection_image'])) {
            $collection->updateFile($newDetails['collection_image'], 'collection_image');
        }
        $collection['collection_image'] = $collection->getFirstMediaUrl('collection_image', 'thumb');
        return $collection;
    }

    /**
     * renameAdminCollection function
     *
     * @param [type] $details
     * @return void
     */
    public function renameAdminCollection($details)
    {
        $collection = Collection::findOrFail($details['collection_id']);
        $collection->update(['name' => $details['name']]);
        return $collection;
    }


    /**
     * publishAdminCollection function
     *
     * @param [type] $details
     * @return void
     */
    public function publishAdminCollection($details){
        $collection = Collection::findOrFail($details['collection_id']);
        $collection->update(['is_published' => $details['published']]);
        return $collection;

    }

}
