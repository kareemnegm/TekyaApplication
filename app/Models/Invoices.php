<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_id',
        'status',
        'discount',
        'shipment_fees',
        'total_product_price',
        'total_invoice',
        'invoice_date',
        'taxes',
        'shop_invoice_number'

    ];
}
