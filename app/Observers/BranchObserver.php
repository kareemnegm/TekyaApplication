<?php

namespace App\Observers;

use App\Models\providerShopBranch;

class BranchObserver
{

    public function creating(providerShopBranch $providerShopBranch)
    {
        if ($providerShopBranch->is_head == 1) {
            providerShopBranch::where('shop_id', $providerShopBranch->shop_id)->update(['is_head' => 0]);
        }
    }
    /**
     * Handle the providerShopBranch "created" event.
     *
     * @param  \App\Models\providerShopBranch  $providerShopBranch
     * @return void
     */
    public function created(providerShopBranch $providerShopBranch)
    {
    }

    /**
     * Handle the providerShopBranch "updated" event.
     *
     * @param  \App\Models\providerShopBranch  $providerShopBranch
     * @return void
     */
    public function updating(providerShopBranch $providerShopBranch)
    {
        if ($providerShopBranch->is_head == 1) {
            providerShopBranch::where('shop_id', $providerShopBranch->shop_id)->update(['is_head' => 0]);
        }
    }

    /**
     * Handle the providerShopBranch "deleted" event.
     *
     * @param  \App\Models\providerShopBranch  $providerShopBranch
     * @return void
     */
    public function deleted(providerShopBranch $providerShopBranch)
    {
        //
    }

    /**
     * Handle the providerShopBranch "restored" event.
     *
     * @param  \App\Models\providerShopBranch  $providerShopBranch
     * @return void
     */
    public function restored(providerShopBranch $providerShopBranch)
    {
        //
    }

    /**
     * Handle the providerShopBranch "force deleted" event.
     *
     * @param  \App\Models\providerShopBranch  $providerShopBranch
     * @return void
     */
    public function forceDeleted(providerShopBranch $providerShopBranch)
    {
        //
    }
}
