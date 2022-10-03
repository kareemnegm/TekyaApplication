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


}
