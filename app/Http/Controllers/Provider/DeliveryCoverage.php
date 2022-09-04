<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\DeliveryCoverageFormRequest;
use App\Interfaces\DeliveryCoverageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryCoverage extends Controller
{


    private DeliveryCoverageInterface $deliveryCoverageRepository;
    public function __construct(DeliveryCoverageInterface $deliveryCoverageRepository)
    {
        $this->deliveryCoverageRepository = $deliveryCoverageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryCoverageFormRequest $request)
    {
        $details = $request->input();
        $shop_id = Auth::user()->providerShopDetails->id;
        $details['shop_id'] = $shop_id;
        return $this->dataResponse(['delivery_coverage'=>$this->deliveryCoverageRepository->deliveryCoverage($details)],'created successful',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
