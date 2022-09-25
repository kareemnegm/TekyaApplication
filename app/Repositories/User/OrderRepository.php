<?php

namespace App\Repositories\User;

use App\Http\Resources\User\CartProductResource;
use App\Http\Resources\User\UserCartResource;
use App\Interfaces\User\CartInterface;
use App\Interfaces\User\OrderInterface;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderInvoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderRepository implements OrderInterface
{

    

      /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function orderReview($request){

        $limit=$request->limit ?$request->limit:10;

        $user=auth()->user();
        $q=$user->cart->product();

        if ($request->page) {
            $reviewOrder = $q->select(['provider_shop_details.id,provider_shop_details.shop_name'])->distinct()->paginate($limit);
        } else {
            $reviewOrder = $q->with('shop')->get()->groupBy('shop.id');

            // $reviewOrder = $q->select(['provider_shop_details_id'])->distinct()->get();
        }

        return $reviewOrder;
    }


    /**
     * Place Order function
     *
     * @param [type] $projectId
     * @return void
     */
    public function placeOrder($req){


        $totalProducts=0;
        $totalPriceProduct=0;
        $totalShipments=0;

        foreach ($req['shops'] as $arr) {
            $totalProducts+= count($arr['products']);
            $totalShipments+= $arr['shipping_fees'];
            $totalPriceProduct+= $arr['total_price'];
        }


        $user_id=auth('user')->user()->id;
        $orderInvoice['user_id']=$user_id;
        $orderInvoice['shipping_fees']=$totalShipments;
        $orderInvoice['total_product_price']=$totalProducts;
        $orderInvoice['tekya_wallet']=$req['tekya_wallet'];
        $orderInvoice['tekya_points']=$req['tekya_points'];
        $orderInvoice['taxes']=$req['taxes'];

        dd($totalPriceProduct+$totalShipments-$req['tekya_wallet']-$req['tekya_points']);
        if($req['tekya_points'] == $totalPriceProduct+$totalShipments-$req['tekya_wallet']-$req['tekya_points'])
        $orderInvoice['taxes']=

        

        OrderInvoice::create([


        ]);
       

        $order['date_order_placed']=Carbon::now();



        $latestOrder = Order::orderBy('created_at','DESC')->first();

        $latestOrderId=$latestOrder ? $latestOrder->id :1;

        $req['order_number'] = '#'.str_pad($latestOrderId + 1, 8, "0", STR_PAD_LEFT);

        $createOrder=Order::create($req);
    }
}



