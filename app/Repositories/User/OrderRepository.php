<?php

namespace App\Repositories\User;

use App\Http\Resources\User\CartProductResource;
use App\Http\Resources\User\UserCartResource;
use App\Interfaces\User\CartInterface;
use App\Interfaces\User\OrderInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function placeOrder($request){
        $user=auth()->user();
        return $user->cart->providerShopDetails()->distinct()->get();
    }
}
