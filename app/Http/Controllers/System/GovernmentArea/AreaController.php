<?php

namespace App\Http\Controllers\System\GovernmentArea;

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
        $data =  Area::create($request->validated());
        return $this->dataResponse(['area' => $data], 'created successful', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->dataResponse(['area' => new AreaResource(Area::findOrFail($id))], 'success', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->dataResponse(['area' => AreaResource::collection(Area::all())], 'OK', 200);
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
        return $this->dataResponse(['area' => AreaResource::collection($area)], 'OK', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaFormRequest $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update([$request->validated()]);
        return $this->dataResponse(['area' => $area], 'update successful', 200);
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
        return $this->successResponse('Deleted Sucessfully', 200);
    }
}
