<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShipment extends Model
{
    use HasFactory;

    protected $table='order_shipments';

    protected $fillable = [
        'order_shop_id',
        'address_id',
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
    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

}
