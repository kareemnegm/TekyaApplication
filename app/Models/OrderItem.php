<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_shop_id',
        'product_id',
        'quantity',
        'unit_price',
        'unit_total',

    ];



   
    /**
     * Undocumented function
     *
     * @return void
     */
     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
