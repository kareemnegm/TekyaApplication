<?php

namespace App\Repositories;

use App\Interfaces\CollectionInterface;
use App\Interfaces\CustomerInterface;
use App\Models\Collection;
use App\Models\Invoices;
use App\Models\Order;
use App\Models\OrderShop;
use Illuminate\Support\Facades\DB;

class CustomerRepository implements CustomerInterface
{

    /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function customerOrdersList($request)
    {

        $shop_id = auth('provider')->user()->providerShopDetails->id;

         $customerOrders=Order::whereHas('orderShops' , function($query)use($shop_id) {
            $query->where('shop_id',$shop_id);
        })
        ->withSum('orderShops.invoice','total_invoice')

        ->select('total_invoice','user_id', DB::raw('count(*) as total'))
        ->groupBy('user_id','total_invoice')
        ->get();

        dd($customerOrders);

        
    }

     /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function customerOrderDetails($request)
    {

    }


    
     /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function orderShopUserId($request)
    {
        $orders=Order::get();
        foreach($orders as $order){
            $orderShop=OrderShop::where('order_id',$order->order_id)->update(['user_id'=>$order->user_id]);
        }

        $ordersShops=OrderShop::get();

        foreach($ordersShops as $shop){
            $shop->invoice->update(['user_id'=>$shop->user_id]);
        }

    }



}
