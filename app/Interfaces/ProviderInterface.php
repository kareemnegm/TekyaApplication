<?php

namespace App\Interfaces;

interface ProviderInterface
{



    /**
     * Delete Provider Account function
     *
     * @return void
     */
    public function deleteProvider();

    public function createShopDetails($details);
    public function updateShopDetails($details, $id);
    public function getShopDetails($id);
    public function getShopByCategoryId($id, $details);

    /**
     * !branch section
     */
    public function createBranch($details);
    public function updateBranch($details, $id);
    public function getBranches($id, $details);
    public function deleteBranch($id);
    public function BranchAddress($branchDetails);
    public function  getBranch($details);
    public function  branchDeliveryPickUpToggle($details);

    /**
     * ! end of branch section
     */
}
