<?php

namespace App\Repositories;

use App\Interfaces\ProviderOrderInterface;
use App\Models\DeliveryOption;
use App\Models\Order;
use App\Models\OrderShop;
use App\Models\Product;
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


        $shopOrder = OrderShop::where('shop_id', $shop_id)->with('order')->
        with('invoice')->withSum('orderItems', 'quantity')->get();

        return $shopOrder;
    }


    /**
     * Undocumented function
     *
     * @param [type] $provider_id
     * @param [type] $orderId
     * @return void
     */
    public function orderDetails($provider_id,$orderId){

        $order = OrderShop::where('shop_id', $provider_id)->where('order_id', $orderId)->firstOrFail();

        return  $order;
    }

    /**
     * Undocumented function
     *
     * @param [type] $order_shop_id
     * @return void
     */
    public function UpdateOrderDeliveryStatus($order_shop_id)
    {
        $shopOrder = OrderShop::findOrFail($order_shop_id['order_shop_id']);
        $shopOrder->deliveryType->update(['order_shop_status' => $order_shop_id['status']]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $order_shop_id
     * @return void
     */
    public function branchStatistics($shop_id)
    {
        $shopOrder = OrderShop::where('shop_id', $shop_id)->CreatedToday()->count();

        $outOfStock = Product::where('shop_id', $shop_id)->whereHas('branchStock' , function($query) {
            $query->where('stock_qty', '=', 0);
        })->count();

        $userCanceled = OrderShop::where('shop_id', $shop_id)->whereHas('deliveryType' , function($query) {
            $query->where('order_user_status', '=', 'canceled');
        })->count();        


        return[
            'new_order'=>$shopOrder,
            'out_of_stock'=>$outOfStock,
            'order_canceled'=>$userCanceled
        ];

    }

     /**
     * Undocumented function
     *
     * @param [type] $order_shop_id
     * @return void
     */
    public function finaanceOrders($shop_id,$request)
    {
        $q = OrderShop::where('shop_id', $shop_id)->with('order')->
        with('invoice')->withSum('orderItems', 'quantity');


        if($request['order_type'] == 'recent'){

            $shopOrder=$q->get();

        }elseif($request['order_type'] == 'pickup') {

            $shopOrder= $q->where('model_type','App\Models\OrderPickup')->get();
            
        } elseif($request['order_type'] == 'delivery') {

            $shopOrder= $q->where('model_type','App\Models\OrderShipment')->get();
        }
        elseif($request['order_type'] == 'canceled') {

            $shopOrder= $q->whereHas('deliveryType' , function($query) {
                $query->where('order_user_status', '=', 'canceled');
            })->get();
        }
        

        return $shopOrder;
    }


     /**
     * Undocumented function
     *
     * @param [type] $order_shop_id
     * @return void
     */
    public function finaanceStatistics($shop_id)
    {

        $shopOrder = OrderShop::where('shop_id', $shop_id)->count();

        $outOfStock = Product::where('shop_id', $shop_id)->with('invoice')->get();
        dd($outOfStock);

       


        return[
            'orders'=>$shopOrder,
            // 'out_of_stock'=>$outOfStock,
            // 'order_canceled'=>$userCanceled
        ];
    }


    

}
