<?php

namespace App\Observers;

use App\Models\OrderItem;
use App\Models\Product;

class UpdateStockQuantity
{

    /**
     * Undocumented function
     *
     * @param OrderItem $OrderItem
     * @return void
     */
    public function created(OrderItem $OrderItem){

       Product::where('id',$OrderItem->product_id)->decrement('stock_quantity',$OrderItem->quantity);

    }
}
