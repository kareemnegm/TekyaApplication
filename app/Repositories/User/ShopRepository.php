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

        $limit=$request->limit ?$request->limit:10;

        $q = ProviderShopDetails::query();

            // if ($request->is_publish) {
            //     $is_publish = $request->is_publish === 'true'? 1: 0;
            //     $q->where('is_publish',$is_publish);
            // }

            if ($request->page) {
                $shops = $q->orderBy('id','ASC')->paginate($limit);
            } else {
                $shops = $q->orderBy('id','ASC')->get();
            }

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

        $limit=$request->limit ?$request->limit:10;

            if ($request->category_id) {
                $category = Category::findOrFail($request->category_id);
                $q=$category->shops();
            }else{
                $q = ProviderShopDetails::query();
            }
            // if ($request->is_publish) {
            //     $is_publish = $request->is_publish === 'true'? 1: 0;
            //     $q->where('is_publish',$is_publish);
            // }
            if ($request->page) {
                $shops = $q->orderBy('id','DESC')->paginate($limit);
            } else {
                $shops = $q->orderBy('id','DESC')->get();
            }

        return $shops;
    }


     /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getProductsShop($request,$shopID){

            $limit=$request->limit ?$request->limit:10;

            $shop = ProviderShopDetails::findOrFail($shopID);
            $q=$shop->products();


            if ($request->page) {
                $shops = $q->orderBy('order','ASC')->paginate($limit);
            } else {
                $shops = $q->orderBy('order','ASC')->get();
            }

        return $shops;
    }

     /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getShopDetails($request,$shopID){
        $shop = ProviderShopDetails::findOrFail($shopID);
        return $shop;
    }


      /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getShopBranches($request,$shopID){
        $limit=$request->limit ?$request->limit:10;

        $shop = ProviderShopDetails::findOrFail($shopID);
        $q=$shop->branches();


        if ($request->page) {
            $branches = $q->orderBy('id','ASC')->paginate($limit);
        } else {
            $branches = $q->orderBy('id','ASC')->get();
        }

    return $branches;
    }




}
