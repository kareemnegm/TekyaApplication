<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\OrderShopIdFormRequest;
use App\Http\Resources\Provider\ShopOrdersResource;
use App\Interfaces\ProviderOrderInterface;
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
    public function shopOrders(Request $request)
    {
        $shop_id = Auth('provider')->user()->providerShopDetails->id;
        return $this->paginateCollection(ShopOrdersResource::collection($this->ProviderOrderRepository->shopOrders($shop_id)), $request->limit, 'success');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
