<?php

namespace App\Observers;

use App\Models\Order;

class OrderItemsObserver
{
    
     /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Order $order)
    {
        
    }
}
