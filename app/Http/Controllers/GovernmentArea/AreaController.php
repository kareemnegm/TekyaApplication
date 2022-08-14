<?php

namespace App\Http\Controllers\GovernmentArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaFormRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use App\Models\Government;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaFormRequest $request)
    {
        $data = $request->input();
        Area::create($data);
        return $this->successResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getArea($id)
    {
        return new AreaResource(Area::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllGovernmentAreas($id)
    {
        $area = Area::where('government_id', $id)->get();
        return  AreaResource::collection($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update([$request->input()]);
        return $this->successResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return $this->successResponse();
    }
}
