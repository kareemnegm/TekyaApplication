<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\OrderReviewFormRequest;
use App\Http\Requests\User\PlaceOrderFormRequest;
use App\Http\Resources\User\OrderReviewResource;
use App\Interfaces\User\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Order Private variable
     *
     * @var OrderInterface
     */
    private OrderInterface $orderRepository;
    /**
     * OrderInterface _consturct function
     *
     * @param OrderInterface $orderRepository
     */
    public function __construct(OrderInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Category Products function
     *
     * @param Request $request
     * @return void
     */
    public function orderReview(OrderReviewFormRequest $request)
    {
        $orderProdcuts=$this->orderRepository->orderReview($request->all());

        return $this->dataResponse([
            $orderProdcuts], 'OK', 200);
    

    }


    
    /**
     * Category Products function
     *
     * @param Request $request
     * @return void
     */
    public function placeOrder(PlaceOrderFormRequest $request)
    {
        $orderProdcuts=$this->orderRepository->placeOrder($request->validated());

        return $this->dataResponse([
            $orderProdcuts], 'Order Checkout Successfully', 201);


    }
}
