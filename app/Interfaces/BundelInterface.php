<?php

namespace App\Interfaces;

interface BundelInterface{

   /**
     * All Shop Bundels function
     *
     * @return void
     */
    public function getAllShopBundel($request);
    /**
     * Single Bundel Shop function
     *
     * @param [type] $bundelID
     * @return void
     */
    public function getBundelById($bundelID,$request);
    /**
     * Delete Bundel Shop function
     *
     * @param [type] $bundelID
     * @return void
     */
    public function deleteShopBundel($bundelID);
    /**
     * Create Bundel Shop function
     *
     * @param array $centerDetails
     * @return void
     */
    public function createShopBundel(array $bundel);
    /**
     * Updated Bundel Shop function
     *
     * @param [type] $bundelID
     * @param array $newDetails
     * @return void
     */
    public function updateShopBundel($bundelID, array $newDetails);



    public function renameBundle($bundleDetails);

}
