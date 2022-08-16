<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'street',
        'address_details',
        'nearest_landmark',
        'notes',
        'area',
        'provider_shop_branch_id',
    ];
    public function providerShopBranch()
    {
        return $this->belongsTo(providerShopBranch::class);
    }
}
