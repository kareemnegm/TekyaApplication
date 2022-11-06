<?php

namespace App\Repositories;

use App\Interfaces\ProviderOrderInterface;
use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\OrderShop;
use Illuminate\Support\Facades\Auth;

class ProviderOrderRepository implements ProviderOrderInterface
{
    /**
     * Undocumented function
     *
     * @param [type] $request
     * @param [type] $shop_id
     * @return void
     */
    public function ShopOrders($request,$shop_id)
    {
         if($request['order_type'] == 'pickup'){

         $optionIds=DeliveryOption::where('shipment_type','branch')->pluck('id');
        }elseif($request['order_type'] == 'delivery'){
            $optionIds=DeliveryOption::where('shipment_type','address')->pluck('id');
        }

        $shopOrder = OrderShop::where('shop_id', $shop_id)->
        whereIn('delivery_option_id',$optionIds)->with('order')->
        with('invoice')->withSum('orderItems', 'quantity')->get();
        
        return $shopOrder;
    }


    public function orderDetails($orderId){
        $order=Order::findOrFail($orderId);
        dd($order);
    }

    public function UpdateOrderDeliveryStatus($order_shop_id)
    {
        $shopOrder = OrderShop::findOrFail($order_shop_id['order_shop_id']);
        $shopOrder->deliveryType->update(['order_shop_status' => $order_shop_id['status']]);
    }
}
