<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'order_status',
        'user_id',
        'address_id',
        'total_price',
        'payment_status',
        'coupon_id',
        'price_before_discount'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
