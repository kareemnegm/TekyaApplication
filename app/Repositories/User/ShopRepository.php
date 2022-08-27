<?php
namespace App\Repositories\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\ShopInrerface;
use App\Models\Category;
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

        $q = ProviderShopDetails::query();
        $shops = $q->orderBy('id','ASC')->get();

        return $shops;
    }
    /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function newShops($request){

        $q = ProviderShopDetails::query();
        $shops = $q->orderBy('id','DESC')->get();
        return $shops;
    }

    /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function shopsProducts($request){

            if ($request->category_id) {
                $category = Category::findOrFail($request->category_id);
                $q=$category->shops();
            }else{
                $q = ProviderShopDetails::query();
            }

         $shops = $q->orderBy('id','DESC')->get();
        return $shops;
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

                $shops = $q->orderBy('order','ASC')->get();


        return $shops;
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
