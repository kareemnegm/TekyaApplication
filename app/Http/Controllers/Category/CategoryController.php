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

    public function store(CategoryFormRequest $request)
    {
        $details = $request->input();
        $this->CategoryRepository->createCategory($details);
        return $this->successResponse('created successfully',201);
    }

    public function update(CategoryFormRequest $request, $id)
    {
        $details = $request->input();
        $this->CategoryRepository->updateCategory($details, $id);
        return $this->successResponse('updated successfully',200);
    }

    public function index(Request $request)
    {
        return  $this->CategoryRepository->getCategories($request);
    }

    public function delete($id)
    {
        $this->CategoryRepository->deleteCategory($id);
        return $this->successResponse('deleted successfully',200);
    }

    public function show($id){
       return  $this->CategoryRepository->getCategory($id);

    }
}
