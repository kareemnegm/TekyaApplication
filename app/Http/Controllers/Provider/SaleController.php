<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\SaleFormRequest;
use App\Http\Requests\Provider\UpdateSaleFormRequest;
use App\Http\Requests\Provider\UpdateSaleFormRequest as saleIdFormRequest;
use App\Http\Resources\Provider\SaleResource;
use App\Interfaces\SaleInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{


    private SaleInterface $SaleRepository;
    /**
     * Undocumented function
     *
     * @param SaleInterface $SaleRepository
     */
    public function __construct(SaleInterface $SaleRepository)
    {
        $this->SaleRepository = $SaleRepository;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shop_id = Auth::user()->providerShopDetails->id;
        $data = $this->SaleRepository->shopSales($shop_id);
        return $this->paginateCollection(SaleResource::collection($data), $request->limit, 'success');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleFormRequest $request)
    {
        $shop_id = Auth::user()->providerShopDetails->id;
        $data = $request->input();
        $data['shop_id'] = $shop_id;
        $this->SaleRepository->createSale($data);
        return $this->successResponse('sale applied successful', 200);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(saleIdFormRequest $request)
    {
        $id = $request->sale_id;
        $data = $this->SaleRepository->singleSale($id);
        return $this->dataResponse(['sale' => new SaleResource($data)], 'success', 200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleFormRequest $request)
    {
        $details = $request->input();
        $data = $this->SaleRepository->updateSale($details);
        return $this->dataResponse(['sale' => new SaleResource($data)], 'updated successful', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->SaleRepository->deleteSales($id);
        if ($data) {
            return $this->successResponse('deleted successful', 200);
        } else {
            return $this->errorResponseWithMessage('Unauthorized', 401);
        }
    }
}
