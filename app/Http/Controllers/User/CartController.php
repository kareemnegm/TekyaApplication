<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\ProductsFormRequest;
use App\Http\Requests\User\DeleteShopFromCartRequest;
use App\Http\Requests\User\MultiAddProductsCartForRequest;
use App\Http\Requests\User\ProductQuantityFormRequest;
use App\Http\Resources\User\UserCartResource;
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
        $cart=$this->CartRepository->getCartProducts();
        return $this->dataResponse([
            'total_products_price' => $cart['total_products_price'],
            'total_cart_shops' => $cart['total_cart_shops'],
            'total_cart_products' => $cart['total_cart_products']
            ,'cart' => $cart['cart_itmes']], 'OK', 200);
    }

     /**
     * Undocumented function
     *
     * @return void
     */
    public function clearShopsFromCarts(DeleteShopFromCartRequest $request)
    {
        $cart=$this->CartRepository->clearShopsFromCarts($request->validated());
        return $this->successResponse('Deleted Successful', 200);

    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function addMultiProductsToCarts(MultiAddProductsCartForRequest $request)
    {
        $cart=$this->CartRepository->addMultiProductsToCarts($request->validated());

    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function cartItemsCount(Request $request)
    {
        $cartItemsCount=$this->CartRepository->cartItemsCount();
        return $this->dataResponse(['cart_items_count' => $cartItemsCount], 'OK', 200);
    }

}
