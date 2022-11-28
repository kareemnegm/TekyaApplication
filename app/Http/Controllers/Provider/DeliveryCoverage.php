<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\DeliveryCoverageFormRequest;
use App\Http\Requests\Provider\UpdateDeliveryCoverageFormRequest;
use App\Http\Resources\Provider\DeliveryCoverageResource;
use App\Interfaces\DeliveryCoverageInterface;
use App\Models\deliveryCoverage as ModelsDeliveryCoverage;
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
        $shop_id = Auth::user()->providerShopDetails->id;
        return $this->dataResponse(['delivery_coverage' => DeliveryCoverageResource::collection($this->deliveryCoverageRepository->getAllDeliveryCoverage($shop_id))], 'success', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryCoverageFormRequest $request)
    {
        $details = $request->validated();
        $shop_id = Auth::user()->providerShopDetails->id;
        $details['shop_id'] = $shop_id;
        return $this->dataResponse(['delivery_coverage' => new DeliveryCoverageResource($this->deliveryCoverageRepository->storeCoverage($details))], 'created successful', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop_id = Auth::user()->providerShopDetails->id;
        $coverageAreas = ModelsDeliveryCoverage::where('id', $id)->where('shop_id', $shop_id)->exists();
        if ($coverageAreas) {
            return $this->dataResponse(['delivery_coverage' => new DeliveryCoverageResource($this->deliveryCoverageRepository->getDeliveryCoverage($id))], 'success', 200);
        }
        return $this->errorResponseWithMessage('the delivery coverage Not exists ,or not own this delivery coverage', 401);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryCoverageFormRequest $request,$id)
    {

        $shop_id = Auth::user()->providerShopDetails->id;

        $coverageAreas = ModelsDeliveryCoverage::where('id', $id)->where('shop_id', $shop_id)->exists();

        if ($coverageAreas) {
            return $this->dataResponse(['delivery_coverage' => new DeliveryCoverageResource($this->deliveryCoverageRepository->updateDeliveryCoverage($id, $request->validated()))], 'updated successful', 200);
        }else{
            return $this->errorResponseWithMessage('the delivery coverage Not exists ,or not own this delivery coverage', 401);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->deliveryCoverageRepository->deleteDeliveryCoverage($id);
        return $this->successResponse('deleted successful', 200);
    }
}
