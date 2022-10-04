<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPickup extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_shop_id',
        'branch_id',
        'order_user_status',
        'order_shop_status',
    ];

    /**
     * Get the post's image.
     */
    public function deliveryOptions()
    {
        return $this->morphOne(OrderShop::class, 'model');
    }


      /**
     * Get the post's image.
     */
    public function branch()
    {
        return $this->belongsTo(UserAddress::class, 'branch_id');
    }
}
