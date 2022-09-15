<?php

namespace App\Observers;

use App\Models\Area;
use App\Models\UserAddress;

class UserAddressObserver
{
    /**
     * Handle the UserAddress "creating" event.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return void
     */
    public function creating(UserAddress $userAddress)
    {

        if (isset($userAddress['area_id'])) {
            $areaData = Area::find($userAddress['area_id']);
            $userAddress['government_id'] = $areaData->government_id;
            $userAddress['latitude'] = $areaData->latitude;
            $userAddress['longitude'] = $areaData->longitude;
        }
    }
    /**
     * Handle the UserAddress "created" event.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return void
     */
    public function created(UserAddress $userAddress)
    {
        //
    }

    /**
     * Handle the UserAddress "updating" event.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return void
     */
    public function updating(UserAddress $userAddress)
    {
        if (isset($userAddress['area_id'])&&!empty($userAddress['area_id'])) {
            $areaData = Area::find($userAddress['area_id']);
            $userAddress['government_id'] = $areaData->government_id;
            $userAddress['latitude'] = $areaData->latitude;
            $userAddress['longitude'] = $areaData->longitude;
        }
        else{
            $userAddress['area_id']=null;
            $userAddress['government_id']=null;
        }
    }
    /**
     * Handle the UserAddress "updated" event.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return void
     */
    public function updated(UserAddress $userAddress)
    {
        //
    }

    /**
     * Handle the UserAddress "deleted" event.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return void
     */
    public function deleted(UserAddress $userAddress)
    {
        //
    }

    /**
     * Handle the UserAddress "restored" event.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return void
     */
    public function restored(UserAddress $userAddress)
    {
        //
    }

    /**
     * Handle the UserAddress "force deleted" event.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return void
     */
    public function forceDeleted(UserAddress $userAddress)
    {
        //
    }
}
