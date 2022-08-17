<?php

namespace App\Http\Controllers\Provider\GovernmentArea;

use App\Http\Controllers\Controller;
use App\Http\Requests\GovernmentFormRequest;
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
    public function store(GovernmentFormRequest $request)
    {
        Government::create($request->validated());
        return $this->successResponse('Created Sucessfully',201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->dataResponse(['data'=>new GovernmentResource(Government::findOrFail($id))],'OK',200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->dataResponse(['data'=>GovernmentResource::collection(Government::all())],'OK',200);

    }


    /**
     * Undocumented function
     *
     * @param GovernmentFormRequest $request
     * @param [type] $id
     * @return void
     */
    public function update(GovernmentFormRequest $request, $id)
    {
        $government = Government::findOrFail($id);
        $government->update($request->validated());
        return $this->successResponse('Updated Sucessfully',200);
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
        return $this->successResponse('Deleted Sucessfully',200);
    }
}
