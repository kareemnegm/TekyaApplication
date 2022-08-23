<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ShopResource;
use App\Http\Resources\User\ShopsProductsResoruce;
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
        return ShopResource::collection($nearestShops);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newShops(Request $request)
    {
        $newShops=$this->shopRepository->newShops($request);
        return ShopResource::collection($newShops);
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

   
}
