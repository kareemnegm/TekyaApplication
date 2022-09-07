<?php
namespace App\Repositories\User;

use App\Models\Product;
use App\User\Interfaces\ProductInterface;


class ProductRepository implements ProductInterface
{
    public function mostPopularProduct(){
        $q = Product::query();
        $products = $q->orderBy('id','ASC')->get();

        return $products ;
    }


    public function productJustForYou(){
        $q = Product::query();
        $products = $q->orderBy('id','ASC')->get();

        return $products ;
    }

}
