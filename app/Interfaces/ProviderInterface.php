<?php

namespace App\Interfaces;

interface ProviderInterface{

    public function createShopDetails($details);
    public function updateShopDetails($details,$id);
    public function createBranch($details);
    public function BranchAddress($branchDetails);
}
