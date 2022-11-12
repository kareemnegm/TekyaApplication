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

         $customerOrders=OrderShop::where('shop_id',$shop_id)
        ->select('user_id', DB::raw('count(*) as total'))
        ->orderBy('total','DESC')
        ->groupBy('user_id')

        ->get();

        return  $customerOrders;
        
    }

     /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function customerOrderDetails($user_id)
    {
        $shop_id = auth('provider')->user()->providerShopDetails->id;

        $shopOrder = OrderShop::where('user_id',$user_id)->where('shop_id', $shop_id)->with('order')->
        with('invoice')->withSum('orderItems', 'quantity')->get();

        return $shopOrder;


    }


    
   



}
