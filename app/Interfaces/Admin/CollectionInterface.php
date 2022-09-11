<?php

namespace App\Interfaces\Admin;

interface CollectionInterface
{


    /**
     * getAllAdminShopCollection function
     *
     * @return void
     */
    public function getAllAdminShopCollection($request);
    /**
     * SgetAdminCollectionById function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAdminCollectionById($collectionID);
    /**
     *  deleteAdminShopCollection function
     *
     * @param [type] $centerId
     * @return void
     */
    public function deleteAdminShopCollection($centerId);
    /**
     * createAdminShopCollection function
     *
     * @param array $centerDetails
     * @return void
     */
    public function createAdminShopCollection(array $collection);
    /**
     * updateAdminShopCollection function
     *
     * @param [type] $centerId
     * @param array $newDetails
     * @return void
     */
    public function updateAdminShopCollection($collectionID, array $newDetails);
    /**
     * renameAdminCollection function
     *
     * @param [type] $details
     * @return void
     */
    public function renameAdminCollection($details);
    /**
     * publishAdminCollection function
     *
     * @param [type] $details
     * @return void
     */
    public function publishAdminCollection($details);
}
