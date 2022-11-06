<?php

namespace App\Repositories;

use App\Interfaces\ProviderOrderInterface;
use App\Models\Order;
use App\Models\OrderShop;
use Illuminate\Support\Facades\Auth;

class ProviderOrderRepository implements ProviderOrderInterface
{
    public function ShopOrders($shop_id)
    {
        $shopOrder = OrderShop::where('shop_id', $shop_id)->with('order')->with('invoice')->withSum('orderItems', 'quantity')->get();
        return $shopOrder;
    }


    public function orderDetails($provider_id,$orderId){


        $order = OrderShop::where('shop_id', $provider_id)->where('order_id', $orderId)->firstOrFail();

        return $order;
    }

    public function UpdateOrderDeliveryStatus($order_shop_id)
    {
        $shopOrder = OrderShop::findOrFail($order_shop_id['order_shop_id']);
        $shopOrder->deliveryType->update(['order_shop_status' => $order_shop_id['status']]);
    }
}
