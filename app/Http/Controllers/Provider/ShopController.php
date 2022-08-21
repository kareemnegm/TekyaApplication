<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopBranchFormRequest;
use App\Http\Requests\ShopDetailsFormRequest;
use App\Interfaces\ProviderInterface;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    /**
     * Undocumented variable
     *
     * @var ProviderInterface
     */
    private ProviderInterface $ProviderRepository;

    /***
     *
     */
    public function __construct(ProviderInterface $ProviderRepository)
    {
        $this->ProviderRepository = $ProviderRepository;
    }


    /**
     * Undocumented function
     *
     * @param ShopDetailsFormRequest $request
     * @return void
     */
    public function createShopDetails(ShopDetailsFormRequest $request)
    {

        $provider_id = Auth::user()->id;
        $details = $request->input();
        $details['provider_id'] = $provider_id;
        $this->ProviderRepository->createShopDetails($details);
        return $this->successResponse();
    }


    public function updateShopDetails(ShopDetailsFormRequest $request)
    {
        $provider_id = Auth::user()->id;
        $details = $request->all();
        $this->ProviderRepository->updateShopDetails($details, $provider_id);
        return $this->successResponse('updated successful', 200);
    }



    public function getShopDetails()
    {
        $provider_id = Auth::user()->id;
       return $this->dataResponse(['data'=>$this->ProviderRepository->getShopDetails($provider_id)],'success',200);
    }

    public function getShopByCategoryId($id,Request $request){
        return $this->ProviderRepository->getShopByCategoryId($id,$request);
    }
}
