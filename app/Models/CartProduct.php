<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $table = 'cart_product';
    
    protected $fillable = [
        'id',
        'product_id',
        'cart_id',
        'provider_shop_details_id',
        'quantity'

    ];
}
