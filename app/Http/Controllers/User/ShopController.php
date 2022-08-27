<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProductsResource;
use App\Http\Resources\User\ShopBracnhesResource;
use App\Http\Resources\User\ShopResource;
use App\Http\Resources\User\ShopsProductsResoruce;
use App\Http\Resources\User\ShopsResource;
use App\Interfaces\User\ShopInrerface;
use Illuminate\Http\Request;

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
        $nearestShops=$this->shopRepository->nearestShops($request);


        return ShopsResource::collection($nearestShops);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newShops(Request $request)
    {
        $newShops=$this->shopRepository->newShops($request);
        return $this->paginateCollection(ShopsResource::collection($newShops),$request->limit,'shop');
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shopsProducts(Request $request)
    {
        $newShops=$this->shopRepository->shopsProducts($request);
        return ShopsProductsResoruce::collection($newShops);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsShop(Request $request,$shopID)
    {
        $products=$this->shopRepository->getProductsShop($request,$shopID);
        return ProductsResource::collection($products);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShopDetails(Request $request,$shopID)
    {
        $products=$this->shopRepository->getShopDetails($request,$shopID);
        return $this->dataResponse(['data'=>new ShopResource($products)],'OK',200);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShopBranches(Request $request,$shopID)
    {
        $products=$this->shopRepository->getShopBranches($request,$shopID);
        return ShopBracnhesResource::collection($products);


    }

}
