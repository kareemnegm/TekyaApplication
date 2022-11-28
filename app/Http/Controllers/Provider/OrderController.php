<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\FinanceOrdersRequest;
use App\Http\Requests\Provider\OrderBranchFormRequest;
use App\Http\Requests\Provider\OrderShopIdFormRequest;
use App\Http\Resources\Provider\ProviderPlacedOrdersDetailsResource;
use App\Http\Resources\Provider\ShopOrdersResource;
use App\Http\Resources\User\PlaceOrderResource;
use App\Interfaces\ProviderOrderInterface;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    private ProviderOrderInterface $ProviderOrderRepository;
    public function __construct(ProviderOrderInterface $ProviderOrderRepository)
    {
        $this->ProviderOrderRepository = $ProviderOrderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shopOrders(OrderBranchFormRequest $request)
    {
        $shop_id = auth('provider')->user()->providerShopDetails->id;
        return $this->paginateCollection(ShopOrdersResource::collection($this->ProviderOrderRepository->shopOrders($request->validated(),$shop_id)), $request->limit, 'orders_shop_list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateOrderStatus(OrderShopIdFormRequest $order_shop)
    {
        $this->ProviderOrderRepository->UpdateOrderDeliveryStatus(($order_shop->validated()));
        return $this->successResponse('order status now ' . $order_shop['status'], 200);
    }



    public function orderDetails($id)
    {
        $provider_id = auth('provider')->user()->providerShopDetails->id;
        return $this->dataResponse(['order_details'=>new ProviderPlacedOrdersDetailsResource($this->ProviderOrderRepository->orderDetails($provider_id, $id))],'success',200);
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function shopStatistics(Request $request)
    {
        $shop_id = auth('provider')->user()->providerShopDetails->id;

        $order=$this->ProviderOrderRepository->branchStatistics($shop_id);

        return $this->dataResponse(['new_order'=>$order['new_order'],'out_of_stock'=>$order['out_of_stock'],
        'order_canceled'=>$order['order_canceled']],'success',200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function financeOrders(FinanceOrdersRequest $request)
    {
        $shopId = auth('provider')->user()->providerShopDetails->id;
        return $this->paginateCollection(ShopOrdersResource::collection($this->ProviderOrderRepository->finaanceOrders($shopId, $request->validated())), $request->limit, 'orders_shop_list');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function financeStatistics(Request $request)
    {
        $shop_id = auth('provider')->user()->providerShopDetails->id;

        $order=$this->ProviderOrderRepository->financeStatistics($shop_id);

        return $this->dataResponse(['orders'=>$order['orders'],'income'=>$order['income'],
        'cash'=>$order['cash']],'success',200);

    }

}

