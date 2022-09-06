<?php

namespace App\Repositories\User;

use App\Http\Resources\User\CartProductResource;
use App\Http\Resources\User\UserCartResource;
use App\Interfaces\User\CartInterface;
use App\Interfaces\User\OrderInterface;
use App\Models\Cart;
use App\Models\Order;
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

        $req['user_id']=auth('user')->user()->id;
        $req['date_order_placed']=Carbon::now();

        $req['order_details']=json_encode($req['order_details']);

        $req['invoices_total']=json_encode($req['invoices_total']);

        $latestOrder = Order::orderBy('created_at','DESC')->first();

        $latestOrderId=$latestOrder ? $latestOrder->id :1;

        $req['order_number'] = '#'.str_pad($latestOrderId + 1, 8, "0", STR_PAD_LEFT);

        $createOrder=Order::create($req);
    }
}



