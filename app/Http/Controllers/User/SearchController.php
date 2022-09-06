<?php

namespace App\Http\Controllers\User;

use App\Classes\SearchClass;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private SearchClass $SearchClass;


    public function __construct(SearchClass $SearchClass)
    {
        $this->SearchClass = $SearchClass;
    }


    public function search(Request $request)
    {
        $model_result = $this->SearchClass->search($request);
        return $this->dataResponse(['data' => $model_result]);
    }
}
