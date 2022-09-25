<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInvoice extends Model
{
    use HasFactory;

    protected $table='order_invoices';

    protected $fillable = [
        'id',
        'user_id',
        'total_product_price',
        'tekya_wallet',
        'tekya_points',
        'shipping_fees',
        'grand_total_price'
        ,'taxes',
        'order_invoice_number'
    ];
}
