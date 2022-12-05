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
        'address',
        'street',
        'address_details',
        'nearest_landmark',
        'notes',
        'area_id',
        'government_id',
        'latitude',
        'longitude',
        'pick_up',
        'delivery',
    ];


    public function government()
    {
        return $this->belongsTo(Government::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function branchStock()
    {
        return $this->hasMany(BranchProductStock::class,'branch_id');
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class, 'shop_id');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function provider_shop_details()
    {
        return $this->belongsTo(ProviderShopDetails::class, 'id');
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



    public function scopeByDistance($query, $latitude, $longitude, $shopIDs = null, $distance = null, $unit = "km")
    {
        $distance = 30;
        $constant = $unit == "km" ? 6371 : 3959;

        $haversine = "(
            6371 * acos(
                cos(radians(" . $latitude . "))
                * cos(radians(`latitude`))
                * cos(radians(`longitude`) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . ")) * sin(radians(`latitude`))
            )
        )";
        if (!empty($shopIDs)) {
            return providerShopBranch::with('shop')->whereIn('shop_id', $shopIDs)->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"),'latitude','longitude')
                ->having("distance", "<=", $distance)
                ->orderby("distance", "asc")->get();
        } else {
            dd ( providerShopBranch::with('shop')->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"),'latitude','longitude')
                ->having("distance", "<=", $distance)
                ->orderby("distance", "asc")->get());
        }
    }


    public function scopeDistanceBranches($query, $latitude, $longitude, $shopIDs = null, $distance = null, $unit = "km")
    {
        $distance = 30;
        $constant = $unit == "km" ? 6371 : 3959;

        $haversine = "(
            6371 * acos(
                cos(radians(" . $latitude . "))
                * cos(radians(`latitude`))
                * cos(radians(`longitude`) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . ")) * sin(radians(`latitude`))
            )
        )";
        if (!empty($shopIDs)) {
            return providerShopBranch::with('shop')->whereIn('shop_id', $shopIDs)->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"),'latitude','longitude')
                ->orderby("distance", "asc")->get();
        } else {
            return  providerShopBranch::with('shop')->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"),'latitude','longitude')
                ->orderby("distance", "asc")->get();
        }
    }

    public function scopeNearestBranch($query, $latitude, $longitude, $shop_id ,$distance = null, $unit = "km")
    {
        $distance = 30;
        $constant = $unit == "km" ? 6371 : 3959;

        $haversine = "(
            6371 * acos(
                cos(radians(" . $latitude . "))
                * cos(radians(`latitude`))
                * cos(radians(`longitude`) - radians(" . $longitude . "))
                + sin(radians(" . $latitude . ")) * sin(radians(`latitude`))
            )
        )";

       return  providerShopBranch::where('shop_id',$shop_id)->select(DB::raw("$haversine AS distance, id as id , name as name,shop_id as shop_id"),'latitude','longitude')
                ->orderby("distance", "asc")
                ->having("distance", "<=", $distance);

    }


}
