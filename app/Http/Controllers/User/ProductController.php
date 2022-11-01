<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Provider\VariantValueResource;
use App\Http\Resources\User\ProductResource;
use App\Http\Resources\User\ProductsResource;
use App\Interfaces\User\ProductInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var ProviderInterface
     */
    private ProductInterface $ProductRepository;
    /**
     * Undocumented function
     *
     * @param ProviderInterface $ProviderRepository
     */
    public function __construct(ProductInterface $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }


    public function productsForYou(Request $request)
    {

        //! in teh if conndition should handle the nearest and the products for the user when he is logged in
        if (Auth::check()) {
            $user_id = auth('user')->user->id;
            dd($user_id);
            $products = $this->ProductRepository->productJustForYou();
            return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
        }

        $products = $this->ProductRepository->productJustForYou();
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
    }



    public function mostPopularProduct(Request $request)
    {
        $products = $this->ProductRepository->mostPopularProduct();
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function relatedProducts(Request $request,$product_id)
    {
        $products = $this->ProductRepository->relatedProducts($product_id);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'related_products');
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function similarProducts(Request $request,$product_id)
    {
        $products = $this->ProductRepository->similarProducts($product_id);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'similar_products');
    }


    public function showProduct($id)
    {
        $product = Product::findOrFail($id);
        return $this->dataResponse(['product' => new ProductResource($product)], 'success', 200);
    }


    public function getVariantsValues(Request $variant_id)
    {
        return $this->dataResponse(['values'=>VariantValueResource::collection($this->ProductRepository->getVariantsValues($variant_id->variant_id))],'success',200);
    }
}
