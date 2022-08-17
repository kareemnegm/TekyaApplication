<?php

namespace App\Classes;

use App\Interfaces\ProviderInterface;
use App\Models\BranchAddress;
use App\Models\Provider;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;

class ProviderClass implements ProviderInterface{
    
    public function createShopDetails($details){
        ProviderShopDetails::create($details);
    }

    public function createBranch($details){
        $data=providerShopBranch::create($details);
        return $data;
    }


    public function BranchAddress($branchDetails){
        BranchAddress::create($branchDetails);
    }

}
