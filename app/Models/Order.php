<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_number',
        'user_id',
        'order_status',
        'payment_id',
        'date_order_placed',
        'order_invoice_id',
        'total_items',
        'total_shop'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
