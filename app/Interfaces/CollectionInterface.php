<?php

namespace App\Interfaces;

interface CollectionInterface{

   /**
     * All Ceneters Of Project function
     *
     * @return void
     */
    public function getAllShopCollection($request);
    /**
     * Single Project Ceneter function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getCollectionById($collectionID);
    /**
     * Delete Center function
     *
     * @param [type] $centerId
     * @return void
     */
    public function deleteShopCollection($centerId);
    /**
     * Undocumented function
     *
     * @param array $centerDetails
     * @return void
     */
    public function createShopCollection(array $collection);
    /**
     * Undocumented function
     *
     * @param [type] $centerId
     * @param array $newDetails
     * @return void
     */
    public function updateShopCollection($collectionID, array $newDetails);





}
