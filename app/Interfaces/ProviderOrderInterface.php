<?php

namespace App\Interfaces;

interface ProviderOrderInterface
{

    public function ShopOrders($shop_id);
    public function orderDetails($provider_id,$orderId);

    public function UpdateOrderDeliveryStatus($order_shop_id);
}
