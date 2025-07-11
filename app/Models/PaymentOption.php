<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function providerShopBranch()
    {
        return $this->belongsToMany(providerShopBranch::class,'shop_branch_payments');
    }


    
}
