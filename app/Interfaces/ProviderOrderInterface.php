<?php

namespace App\Interfaces;

interface ProviderOrderInterface
{

    public function ShopOrders($request,$shop_id);
    public function orderDetails($orderId);

    public function UpdateOrderDeliveryStatus($order_shop_id);
}
