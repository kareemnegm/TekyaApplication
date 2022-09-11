<?php

namespace App\Repositories\Admin;

use App\Http\Resources\Provider\ShopDetailsResource;
use App\Interfaces\Admin\ProviderInterface;
use App\Models\BranchAddress;
use App\Models\Provider;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;

class ProviderRepository  implements ProviderInterface
{
    public function updateShopDetails($details, $id)
    {
        $shopDetails = ProviderShopDetails::where('id', $id)->first();
        if (isset($details['shop_logo'])) {
            $shopDetails->saveFiles($details['shop_logo'], 'shop_logo');
        } else {
            $shopDetails->clearMediaCollectionExcept('shop_logo');
        }
        if (isset($details['shop_cover'])) {
            $shopDetails->saveFiles($details['shop_cover'], 'shop_cover');
        } else {
            $shopDetails->clearMediaCollectionExcept('shop_cover');
        }
        $shopDetails->update($details);
        $shopProvider = ProviderShopDetails::find($shopDetails->id);
        $shopProvider->category()->sync($details['category_id']);
    }



    public function getShopDetails($id)
    {
        $shopDetails = ProviderShopDetails::where('id', $id)->first();
        return new  ShopDetailsResource($shopDetails);
    }




    public function getShops()
    {
        $shops = ProviderShopDetails::get();
        return $shops;
    }


    public function suspendShop($id){
        $shop=ProviderShopDetails::where('id',$id)->update(['status'=>'suspended']);
    }


    public function createBranch($details)
    {
        $details['working_hours_day'] = json_encode($details['working_hours_day']);
        $data = providerShopBranch::create($details);
        $data->paymentOption()->syncWithoutDetaching($details['payment_option_id']);
        return $data;
    }


    public function BranchAddress($branchDetails)
    {
        return  BranchAddress::create($branchDetails);
    }


    public function getBranches($id, $details)
    {

        $branches = providerShopBranch::where('shop_id', $id)->get();
        return $branches;
    }


    public function getBranch($id)
    {
        $branches = providerShopBranch::findOrFail($id);
        return $branches;
    }

    public function updateBranch($details, $id)
    {
        $branch = providerShopBranch::findOrFail($id);
        if (isset($details['address']) && !empty($details['address'])) {
            $address = BranchAddress::where('id', $branch->branch_address_id)->first();
            $address->update($details);
        }
        if (isset($details['working_hours_day'])) {
            $details['working_hours_day'] = json_encode($details['working_hours_day']);
        }
        $branch->update($details);
        return $branch;
    }



    public function deleteBranch($id)
    {
        $branch = providerShopBranch::findOrFail($id);
        $branch->delete();
    }
}
