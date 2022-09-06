<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CategoriesResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function shopProductsCategories()
    {
        $shop_id = Auth::user()->providerShopDetails->id;
        $products = Product::where('shop_id', $shop_id)->distinct('category_id')->pluck('category_id');

        $categories = Category::whereIn('id', $products)->get();
        return $this->dataResponse(['category' => CategoriesResource::collection($categories)],'success', 200);
    }
}
