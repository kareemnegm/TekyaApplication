<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'shop_id',
        'invoice_id',
        'delivery_option_id',
        'total_items',
        'note',

    ];
}
