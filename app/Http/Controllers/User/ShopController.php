<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsShopFormRequest;
use App\Http\Requests\User\ShopIdFormRequest;
use App\Http\Resources\User\ProductsResource;
use App\Http\Resources\User\ShopBracnhesResource;
use App\Http\Resources\User\ShopResource;
use App\Http\Resources\User\ShopsProductsResoruce;
use App\Http\Resources\User\ShopsResource;
use App\Interfaces\User\ShopInrerface;
use App\Models\Area;
use App\Models\Category;
use App\Models\Product;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;
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
    public function getProductsShop(ProductsShopFormRequest $request)
    {
        $products = $this->shopRepository->getProductsShop($request);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShopDetails(ShopIdFormRequest $request)
    {
        if (auth('user')->check()) {
            $userLocation = auth('user')->user()->userLocation;
            if ($userLocation) {
                $request['latitude'] = $userLocation->latitude;
                $request['longitude'] = $userLocation->longitude;
            }
        } elseif (isset($request->area_id) && !empty($request->area_id)) {
            $area = Area::findOrFail($request->area_id);
            $request['latitude'] = $area->latitude;
            $request['longitude'] = $area->longitude;
        }


        $products = $this->shopRepository->getShopDetails($request);

        if ($products == null) {
            return $this->dataResponse([], 'OK', 200);
        }
        return $this->dataResponse(['shop' => new ShopResource($products)], 'OK', 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShopBranches(ShopIdFormRequest $request)
    {
        // if (auth('user')->check()) {
        //     $userLocation = auth('user')->user()->userLocation;
        //     if ($userLocation) {
        //         $request['latitude'] = $userLocation->latitude;
        //         $request['longitude'] = $userLocation->longitude;
        //     }
        // }
        $branches = $this->shopRepository->getShopBranches($request);
        return $this->paginateCollection(ShopBracnhesResource::collection($branches), $request->limit, 'branches');
    }


    public function relatedShops(Request $request,$productId)
    {
        if (auth('user')->check()) {
            $userLocation = auth('user')->user()->userLocation;
            if ($userLocation) {
                $request['latitude'] = $userLocation->latitude;
                $request['longitude'] = $userLocation->longitude;
            }
        } elseif (isset($request->area_id) && !empty($request->area_id)) {
            $area = Area::findOrFail($request->area_id);
            $request['latitude'] = $area->latitude;
            $request['longitude'] = $area->longitude;
        }


        $shops = $this->shopRepository->relatedShops($request,$productId);


        return $this->paginateCollection(ShopsResource::collection($shops), $request->limit, 'related_shops');

    }
}
