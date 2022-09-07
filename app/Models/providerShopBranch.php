<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class providerShopBranch extends Model
{
    use HasFactory;

    protected $table = 'provider_shop_branches';

    protected $fillable = [
        'name',
        'phone',
        'is_head',
        'working_hours_day',
        'shop_id',
        'is_active',
        'branch_address_id'
    ];


     /**
     * Undocumented function
     *
     * @return void
     */
    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class,'shop_id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function provider_shop_details()
    {
        return $this->belongsTo(ProviderShopDetails::class,'id');
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function paymentOption()
    {
        return $this->belongsToMany(PaymentOption::class, 'shop_branch_payments');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function BranchAddress()
    {
        return $this->belongsTo(BranchAddress::class);
    }


    public function scopeByDistance($query,$latitude, $longitude, $shopIDs=null,$distance = null, $unit = "km")
    {
        $distance= 30;
        $constant = $unit == "km" ? 6371 : 3959;

        $haversine = "(
            6371 * acos(
                cos(radians(" .$latitude. "))
                * cos(radians(`latitude`))
                * cos(radians(`longitude`) - radians(" .$longitude. "))
                + sin(radians(" .$latitude. ")) * sin(radians(`latitude`))
            )
        )";

        if(!empty($shopIDs)){
        return providerShopBranch::with('shop')->whereIn('shop_id',$shopIDs)->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"))
            ->having("distance", "<=", $distance)
            ->orderby("distance", "asc")->get()->unique('shop_id');
        }else{
            return  providerShopBranch::with('shop')->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"))
            ->having("distance", "<=", $distance)
            ->orderby("distance", "asc")->get()->unique('shop_id');
            
        }


    }
}
