<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\User\CategoriesResource;
use App\Http\Resources\User\ProductsResource;
use App\Http\Resources\User\ShopResource;
use App\Http\Resources\User\SubCategoriesResource;
use App\Interfaces\User\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Undocumented variable
     *
     * @var CategoryInterface
     */
    private CategoryInterface $CategoryRepository;
    /**
     * Undocumented function
     *
     * @param CategoryInterface $CategoryRepository
     */
    public function __construct(CategoryInterface $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getCategories(Request $request)
    {
        $mainCategoires=$this->CategoryRepository->getCategories($request);
        return CategoriesResource::collection($mainCategoires);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getSubCategories(Request $request,$categoryID)
    {
        $mainCategoires=$this->CategoryRepository->getSubCategories($request,$categoryID);
        return SubCategoriesResource::collection($mainCategoires);
    }

    /**
     * Category Products Shop function
     *
     * @param Request $request
     * @return void
     */
    public function categoryShops(Request $request,$categoryID)
    {
        $categoryShops=$this->CategoryRepository->categoryShops($request,$categoryID);
        return ShopResource::collection($categoryShops);


    }

    /**
     * Category Products function
     *
     * @param Request $request
     * @return void
     */
    public function categoryProducts(Request $request,$categoryID)
    {
        $categoryProducts=$this->CategoryRepository->categoryShops($request,$categoryID);
        return ProductsResource::collection($categoryProducts);

    }
}
