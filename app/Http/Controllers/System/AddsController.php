<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\AddsFormRequest;
use App\Http\Resources\System\AddsResource;
use App\Models\Add;
use Illuminate\Http\Request;

class AddsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AddsFormRequest $request)
    {     

        $add = Add::create($request->validated());

        if (isset($request['add_image'])) {
            $add->saveFiles($request['add_image'], 'add_image');
        }

        return $this->dataResponse(['adds' => new AddsResource($add)], 'success', 200);
    }
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $add = Add::findOrFail($id);
        return $this->paginateCollection(AddsResource::collection($add), $request->limit, 'admins');
    }

}
