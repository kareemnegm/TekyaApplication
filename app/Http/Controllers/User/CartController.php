<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\ProductsFormRequest;
use App\Http\Requests\User\ProductQuantityFormRequest;
use App\Interfaces\User\CartInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var CartInterface
     */
    private CartInterface $CartRepository;

    /**
     * Undocumented function
     *
     * @param CartInterface $CartRepository
     */
    public function __construct(CartInterface $CartRepository)
    {
        $this->CartRepository = $CartRepository;
    }

    /**
     * Undocumented function
     *
     * @param ProductsFormRequest $request
     * @return void
     */
    public function addProductsToCart(ProductsFormRequest $request)
    {
        return  $this->CartRepository->addProductsToCart($request->validated());

    }
    /**
     * Undocumented function
     *
     * @param ProductsFormRequest $request
     * @return void
     */
    public function IncreaseOrDecreaseProductQuantity(ProductQuantityFormRequest $request)
    {
        return $this->CartRepository->IncreaseOrDecreaseProductQuantity($request->validated());
  
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCartProducts()
    {
        $cart_id = Auth::user()->cart->id;
       return  $this->CartRepository->getCartProducts($cart_id);

    }
}
