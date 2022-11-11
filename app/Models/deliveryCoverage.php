<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deliveryCoverage extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'average_delivery_time',
        'delivery_fees',

    ];

    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class, 'shop_id');
    }

}
