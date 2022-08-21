<?php

namespace App\Interfaces;

interface CategoryInterface{

    public function createCategory($details);
    public function UpdateCategory($details,$id);
    public function getCategories($details);
    public function deleteCategory($id);
    public function getCategory($id);

}
