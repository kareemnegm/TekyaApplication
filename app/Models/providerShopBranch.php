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
        'provider_shop_details_id',
        'is_active'
    ];
    public function provider_shop_details()
    {
        return $this->belongsTo(ProviderShopDetails::class);
    }
    public function paymentOption()
    {
        return $this->belongsToMany(PaymentOption::class, 'shop_branch_payments');
    }

    public function BranchAddress()
    {
        return $this->hasOne(BranchAddress::class);
    }
}
