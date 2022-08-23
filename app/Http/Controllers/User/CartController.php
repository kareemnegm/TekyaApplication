<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\ProductsFormRequest;
use App\Interfaces\CartInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private CartInterface $CartRepository;

    public function __construct(CartInterface $CartRepository)
    {
        $this->CartRepository = $CartRepository;
    }

    public function addProductsToCart(ProductsFormRequest $request)
    {
        $cart_id = Auth::user()->cart->id;
        $products = $request->input();
        $this->CartRepository->addProductsToCart($products, $cart_id);
        return $this->successResponse('added successfully', 200);
    }

    public function IncreaseOrDecreaseProductQuantity(ProductsFormRequest $request)
    {
        $products = $request->input();
        $products['cart_id'] =  Auth::user()->cart->id;

        $this->CartRepository->IncreaseOrDecreaseProductQuantity($products);
        return $this->successResponse('updated successfully', 200);
    }

}
