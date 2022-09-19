<?php
namespace App\Repositories\User;

use App\Models\Product;
use App\Interfaces\User\ProductInterface;

class ProductRepository implements ProductInterface
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function mostPopularProduct(){
        $q = Product::query();
        $products = $q->orderBy('id','ASC')->get();

        return $products ;
    }


    /**
     * Undocumented function
     *
     * @return void
     */
    public function productJustForYou(){
        $q = Product::query();
        $products = $q->orderBy('id','ASC')->get();
        return $products ;
    }


    /**
     * relatedProducts function
     *
     * @return void
     */
    public function relatedProducts($productId){

        $product = Product::findOrFail($productId);

        $relatedProducts =Product::where('id','!=',$product->id)->
        where('caregory_id',$product->category_id)->where('shop_id',$product->shop_id)->get();

        return $relatedProducts ;
    }

    /**
     * similarProducts function
     *
     * @return void
     */
    public function similarProducts($productId){

        $product = Product::findOrFail($productId);

        $similarProducts =Product::where('caregory_id',$product->category_id)->where('shop_id','!=',$product->shop_id)->get();

        return $similarProducts;
    }

}
