<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryInterface $CategoryRepository;
    public function __construct(CategoryInterface $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    public function createCategory(CategoryFormRequest $request)
    {
        $details = $request->input();
        $this->CategoryRepository->createCategory($details);
        return $this->successResponse();
    }

    public function updateCategory(CategoryFormRequest $request, $id)
    {
        $details = $request->input();
        $this->CategoryRepository->updateCategory($details, $id);
        return $this->successResponse();
    }

    public function getCategories()
    {
        return  $this->CategoryRepository->getCategories();
    }

    public function categoryDelete($id)
    {
        $this->CategoryRepository->deleteCategory($id);
        return $this->successResponse();
    }

    public function getCategoryById($id){
       return  $this->CategoryRepository->getCategory($id);

    }
}
