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
}
