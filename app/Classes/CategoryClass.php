<?php

namespace App\Classes;

use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryClass implements CategoryInterface
{
    public function createCategory($details)
    {
        Category::create($details);
    }

    public function UpdateCategory($details, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($details);
    }

    public function getCategories()
    {
        return CategoryResource::collection(Category::where('category_id',null)->with('children')->get());
    }

    public function deleteCategory($id){
        $category=Category::findOrFail($id);
        $category->delete();
    }

    public function getCategory($id){
        return  new CategoryResource(Category::findOrFail($id));
    }
}
