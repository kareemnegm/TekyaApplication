<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShopIdFormRequest;
use App\Http\Resources\User\ProductsResource;
use App\Http\Resources\User\ShopBracnhesResource;
use App\Http\Resources\User\ShopResource;
use App\Http\Resources\User\ShopsProductsResoruce;
use App\Http\Resources\User\ShopsResource;
use App\Interfaces\User\ShopInrerface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var ProviderInterface
     */
    private ShopInrerface $shopRepository;
    /**
     * Undocumented function
     *
     * @param ProviderInterface $ProviderRepository
     */
    public function __construct(ShopInrerface $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nearestShops(Request $request)
    {
         $nearestShops = $this->shopRepository->nearestShops($request);

        return $this->paginateCollection(ShopsResource::collection($nearestShops), $request->limit, 'shops');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newShops(Request $request)
    {
        $newShops = $this->shopRepository->newShops($request);
        return $this->paginateCollection(ShopsResource::collection($newShops), $request->limit, 'shops');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shopsProducts(Request $request)
    {
        $shopsProducts = $this->shopRepository->shopsProducts($request);
        return $this->paginateCollection(ShopsProductsResoruce::collection($shopsProducts), $request->limit, 'shops');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsShop(ShopIdFormRequest $request)
    {
        $products = $this->shopRepository->getProductsShop($request);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShopDetails(Request $request)
    {
        $products = $this->shopRepository->getShopDetails($request);

        return $this->dataResponse(['shop' => new ShopResource($products)], 'OK', 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShopBranches(ShopIdFormRequest $request)
    {
        $branches = $this->shopRepository->getShopBranches($request);
        return $this->paginateCollection(ShopBracnhesResource::collection($branches), $request->limit, 'branches');
    }
}
