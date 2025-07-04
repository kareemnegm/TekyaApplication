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
     * !shop details
     */
    public function createShopDetails($details)
    {
        $provider = ProviderShopDetails::create($details);
    }


    /**
     * Undocumented function
     *
     * @param [type] $details
     * @param [type] $id
     * @return void
     */
    public function updateShopDetails($details, $id)
    {
        $shopDetails = ProviderShopDetails::where('provider_id', $id)->first();
        $branch_id = providerShopBranch::where('shop_id', $shopDetails->id)->first();

        if (isset($details['shop_logo'])) {

            if ($shopDetails->getMedia('shop_logo')) {

                $shopDetails->clearMediaCollectionExcept('shop_logo');
            }

            $shopDetails->saveFiles($details['shop_logo'], 'shop_logo');
        }
        if (isset($details['shop_cover'])) {

            if ($shopDetails->getMedia('shop_cover')) {
                $shopDetails->clearMediaCollectionExcept('shop_cover');
            }

            $shopDetails->saveFiles($details['shop_cover'], 'shop_cover');
        }

        $shopDetails->update($details);
        $shopProvider = ProviderShopDetails::find($shopDetails->id);

        if (isset($details['category_id'])) {
            $shopProvider->category()->sync($details['category_id']);
        }
        $this->updateBranch($details, $branch_id->id);
    }





    public function getShopDetails($id)
    {
        $shopDetails = ProviderShopDetails::where('provider_id', $id)->first();
        return new  ShopDetailsResource($shopDetails);
    }


    public function getShopByCategoryId($id, $details)
    {
        $shops = ProviderShopDetails::where('category_id', $id)->get();
        return ShopDetailsResource::collection($shops);
    }

    /**
     * Delete Provider Account function
     *
     * @return void
     */
    public function deleteProvider()
    {
        $providerId = auth('provider')->user()->id;
        return Provider::findOrFail($providerId)->delete();
    }


    /**
     * !end of shopDetails
     */



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
        return  BranchAddress::create($branchDetails);
    }



    public function getBranch($details)
    {
        $branches = providerShopBranch::findOrFail($details['branch_id']);
        return $branches;
    }
    public function getBranches($id, $details)
    {
        $branches = providerShopBranch::where('shop_id', $id)->get();
        return $branches;
    }

    public function updateBranch($details, $id)
    {
        $branch = providerShopBranch::findOrFail($id);

        if (isset($details['payment_option_id'])) {
            $branch->paymentOption()->syncWithoutDetaching($details['payment_option_id']);
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


    public function branchDeliveryPickUpToggle($details)
    {

        $branch = providerShopBranch::where('shop_id', $details['shop_id'])->firstOrFail();
        $branch->update($details);
    }

    /**
     *!end of branch section
     *
     */
}
