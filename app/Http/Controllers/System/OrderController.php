<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\OrdersFormRequest;
use App\Http\Resources\Admin\OrderResource;
use App\Models\OrderShop;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function ShopOrders(OrdersFormRequest $request)
    {

        $request->validated();

        $q = OrderShop::with('order')->with('invoice')->withSum('orderItems', 'quantity');
        if (isset($request['shop_id']) && !empty($request['shop_id'])) {
            $q = OrderShop::where('shop_id', $request['shop_id'])->with('order')->with('invoice')->withSum('orderItems', 'quantity');
        }
        if (!isset($request['order_type'])) {
            $shopOrder = $q;
        } elseif ($request['order_type'] == 'recent') {

            $shopOrder = $q->orderBy('id', 'desc');
        } elseif ($request['order_type'] == 'pickup') {

            $shopOrder = $q->where('model_type', 'App\Models\OrderPickup');
        } elseif ($request['order_type'] == 'delivery') {

            $shopOrder = $q->where('model_type', 'App\Models\OrderShipment');
        } elseif ($request['order_type'] == 'rejected') {

            $shopOrder = $q->whereHas('deliveryType', function ($query) {
                $query->where('order_shop_status', '=', 'rejected');
            });
        } elseif ($request['order_type'] == 'canceled') {
            $shopOrder = $q->whereHas('deliveryType', function ($query) {
                $query->where('order_user_status', '=', 'canceled');
            });
        }
        if (isset($request['sort']) && !empty($request['sort'])) {
            $shopOrder = $shopOrder->orderBy('id', $request['sort'])->get();
        } else {
            $shopOrder = $shopOrder->get();
        }

        return $this->paginateCollection(OrderResource::collection($shopOrder), $request->limit, 'orders_shop_list');
    }
}
