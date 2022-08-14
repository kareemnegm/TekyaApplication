<?php

namespace App\Http\Controllers\GovernmentArea;

use App\Http\Controllers\Controller;
use App\Http\Resources\GovernmentResource;
use App\Models\Government;
use Illuminate\Http\Request;

class GovernmentController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Government::UpdateOrCreate(['name' => $request->name], ['name' => $request->name]);
        return $this->successResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getGovernment($id)
    {
        return new GovernmentResource(Government::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAllGovernments()
    {
        return  GovernmentResource::collection(Government::all());
    }


    public function update(Request $request, $id)
    {
        $government = Government::findOrFail($id);
        $government->update(['name' => $request->name]);
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
        $government = Government::findOrFail($id);
        $government->delete();
        return $this->successResponse();
    }
}
