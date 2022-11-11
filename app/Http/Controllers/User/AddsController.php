<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\AddsResource;
use App\Models\Add;
use Illuminate\Http\Request;

class AddsController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $adds = Add::get();
        return $this->paginateCollection(AddsResource::collection($adds), $request->limit, 'adds');
    }
}
