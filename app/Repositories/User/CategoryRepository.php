<?php
namespace App\Repositories\User;

use App\Interfaces\User\ShopInrerface;
use App\Models\Category;
use App\Models\ProviderShopDetails;
use App\Interfaces\User\CategoryInterface;

class CategoryRepository implements CategoryInterface
{

    /**
     * Listet Nearts Shop function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getCategories($request){

        $limit=$request->limit ?$request->limit:10;

        $q = Category::query();

            if ($request->page) {
                $categories = $q->orderBy('id','DESC')->whereNull('category_id')->paginate($limit);
            } else {
                $categories = $q->orderBy('id','DESC')->whereNull('category_id')->get();
            }

        return $categories;

    }

    /**
     * Listet Nearts Shop function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getSubCategories($request,$categoryID){
        $limit=$request->limit ?$request->limit:10;

        
        $mainCategory = Category::findOrFail($categoryID);
        $q=$mainCategory->subs();

            if ($request->page) {
                $categories = $q->orderBy('id','DESC')->paginate($limit);
            } else {
                $categories = $q->orderBy('id','DESC')->get();
            }

    return $categories;
    }
    /**
     * New Shop Liste function
     *
     * @param [type] $projectId
     * @return void
     */
    public function categoryShops($request,$categoryID){

        $limit=$request->limit ?$request->limit:10;


            $category = Category::findOrFail($categoryID);
            $q=$category->shops();

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
    public function categoryProducts($request,$categoryID){

        $limit=$request->limit ?$request->limit:10;

            $category = Category::findOrFail($categoryID);
            $q=$category->products();

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

}
