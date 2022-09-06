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
        'address_id',
        'order_status',
        'payment_status',
        'payment_id',
        'date_order_placed',
        'order_details',
        'invoices_total'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
