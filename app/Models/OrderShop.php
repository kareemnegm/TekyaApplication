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



      /**
        * Get the model that the image belongs to.
        */
        public function deliveryType()
        {
            return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
        }


        public function order(){
            return $this->belongsTo(Order::class);
        }

    // public function modelable()
    // {
    //     return $this->morphTo();
    // }
    /**
     * invoice
     */
    public function invoice()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }

     /**
     * shop
     */
    public function shop()
    {
        return $this->belongsTo(ProviderShopDetails::class, 'shop_id');
    }

    /**
     * DeliveryOption
     */
    public function deliveryOption()
    {
        return $this->belongsTo(DeliveryOption::class, 'delivery_option_id');
    }

     /**
     * DeliveryOption
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_shop_id');
    }


     /**
     * DeliveryOption
     */
    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class, 'order_shop_id');
    // }
}


