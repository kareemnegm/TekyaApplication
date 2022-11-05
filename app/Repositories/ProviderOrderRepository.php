<?php

namespace App\Repositories;

use App\Interfaces\ProviderOrderInterface;
use App\Models\OrderShop;
use Illuminate\Support\Facades\Auth;

class ProviderOrderRepository implements ProviderOrderInterface
{
    public function ShopOrders($shop_id)
    {
        $shopOrder = OrderShop::where('shop_id', $shop_id)->with('order')->with('invoice')->withSum('orderItems', 'quantity')->get();
        return $shopOrder;
    }


    public function orderDetails($orderId){
        
    }

    public function UpdateOrderDeliveryStatus($order_shop_id)
    {
        $shopOrder = OrderShop::findOrFail($order_shop_id['order_shop_id']);
        $shopOrder->deliveryType->update(['order_shop_status' => $order_shop_id['status']]);
    }
}
