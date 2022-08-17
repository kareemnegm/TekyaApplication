<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopDetailsFormRequest;
use App\Interfaces\ProviderInterface;
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
    
}
