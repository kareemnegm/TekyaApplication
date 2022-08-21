<?php

namespace App\Classes;

use App\Interfaces\ProviderInterface;
use App\Models\BranchAddress;
use App\Models\Provider;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;

class ProviderClass implements ProviderInterface{

    /**
     * shop details
     */
    public function createShopDetails($details){
        ProviderShopDetails::create($details);
    }


    public function updateShopDetails($details,$id){
        $shopDetails=ProviderShopDetails::where('provider_id',$id)->first();
        $shopDetails->update($details);
    }




    public function createBranch($details){
        $data=providerShopBranch::create($details);
        return $data;
    }


    public function BranchAddress($branchDetails){
        BranchAddress::create($branchDetails);
    }

}
