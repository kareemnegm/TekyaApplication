<?php
namespace App\Repositories\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\ShopInrerface;
use App\Models\Category;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;

class ShopRepository extends Controller implements ShopInrerface
{

    /**
     * Listet Nearts Shop function
     *
     * @param [type] $projectId
     * @return void
     */
    public function nearestShops($request){


        $latitude = 30.012537910528884;
        $longitude = 31.290307442198323;
        $q = providerShopBranch::ByDistance($latitude,$longitude);
        return $q;
    }

    /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function newShops($request){
        $latitude = 30.012537910528884;
        $longitude = 31.290307442198323;
        $q = providerShopBranch::ByDistance($latitude,$longitude);
        return $q;
    }

    /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function shopsProducts($request){


        $latitude = 30.012537910528884;
        $longitude = 31.290307442198323;

            if ($request->category_id) {
                $category = Category::findOrFail($request->category_id);
                $q = providerShopBranch::ByDistance($latitude,$longitude,$category->shops->pluck('id'));

            }else{
                $q = ProviderShopDetails::ByDistance($latitude,$longitude);
            }

        return $q;
    }


     /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getProductsShop($request){


            $shop = ProviderShopDetails::findOrFail($request->shop_id);
            $q=$shop->products();

                $products = $q->orderBy('order','ASC')->get();


        return $products;
    }

     /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getShopDetails($request){
        $shop = ProviderShopDetails::findOrFail($request->shop_id);
        return $shop;
    }


      /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getShopBranches($request){

        $shop = ProviderShopDetails::findOrFail($request->shop_id);
        $q=$shop->branches();

        $branches = $q->orderBy('id','ASC')->get();

        return $branches;
    }




}
