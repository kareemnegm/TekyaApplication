<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class providerShopBranch extends Model
{
    use HasFactory;
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
        return $this->belongsTo(ProviderShopDetails::class,'id');
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
}
