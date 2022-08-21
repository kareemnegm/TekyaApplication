<?php

namespace App\Classes;

use App\Http\Resources\Provider\ShopBranchResource;
use App\Http\Resources\Provider\ShopDetailsResource;
use App\Interfaces\ProviderInterface;
use App\Models\BranchAddress;
use App\Models\Provider;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;

class ProviderClass implements ProviderInterface
{

    /**
     * shop details
     */
    public function createShopDetails($details)
    {

        $provider = ProviderShopDetails::create($details);
    }


    public function updateShopDetails($details, $id)
    {
        $shopDetails = ProviderShopDetails::where('provider_id', $id)->first();

        if (isset($details['shop_logo'])) {
            $shopDetails->saveFiles($details['shop_logo'], 'shop_logo');
        }else{
            $shopDetails->clearMediaCollectionExcept('shop_logo');

        }
        if (isset($details['shop_cover'])) {
            $shopDetails->saveFiles($details['shop_cover'], 'shop_cover');
        }else{
            $shopDetails->clearMediaCollectionExcept('shop_cover');

        }
        $shopDetails->update($details);
    }



    public function getShopDetails($id)
    {
        $shopDetails = ProviderShopDetails::where('provider_id', $id)->first();
        return new  ShopDetailsResource($shopDetails);
    }


    public function getShopByCategoryId($id, $details)
    {
        $limit = $details->limit ? $details->limit : 10;
        $shops = ProviderShopDetails::where('category_id', $id)->paginate($limit);
        return ShopDetailsResource::collection($shops);
    }





    /**
     *!branch section
     *
     */

    public function createBranch($details)
    {
        $details['working_hours_day'] = json_encode($details['working_hours_day']);
        $data = providerShopBranch::create($details);
        $data->paymentOption()->syncWithoutDetaching($details['payment_option_id']);
        return $data;
    }


    public function BranchAddress($branchDetails)
    {
        BranchAddress::create($branchDetails);
    }

    public function getBranches($id,$details)
    {
        $limit = $details->limit ? $details->limit : 10;

        $branches = providerShopBranch::where('provider_shop_details_id', $id)->paginate($limit);
        return ShopBranchResource::collection($branches);
    }

    public function updateBranch($details, $id)
    {
        $branch = providerShopBranch::findOrFail($id);
        if (isset($details['address']) && !empty($details['address'])) {
            $address = BranchAddress::where('provider_shop_branch_id', $branch->id)->first();
            $address->update($details);
        }
        if (isset($details['working_hours_day'])) {
            $details['working_hours_day'] = json_encode($details['working_hours_day']);
        }
        $branch->update($details);
    }

    public function deleteBranch($id)
    {
        $branch = providerShopBranch::findOrFail($id);
        $branch->delete();
    }


    /**
     *!end of branch section
     *
     */
}
