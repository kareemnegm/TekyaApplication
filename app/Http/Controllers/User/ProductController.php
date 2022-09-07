<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProductsResource;
use App\Interfaces\User\ProductInterface;
use Illuminate\Http\Request;

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
        if (\Request::header('Authorization')) {
            $user_id = auth('user')->user->id;
            $products = $this->ProductRepository->productJustForYou();
            return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
        }

        $products = $this->ProductRepository->productJustForYou();
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');

    }



    public function mostPopularProduct(Request $request){
        $products = $this->ProductRepository->mostPopularProduct();
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');

    }
}
