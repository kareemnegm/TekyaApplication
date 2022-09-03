<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvderSignUpFormRequest;
use App\Http\Requests\ProviderLoginFormRequest;
use App\Http\Requests\ShopBranchFormRequest;
use App\Http\Requests\ShopDetailsFormRequest;
use App\Interfaces\ProviderInterface;
use App\Models\Provider;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{



    private ProviderInterface $ProviderRepository;

    public function __construct(ProviderInterface $ProviderRepository)
    {
        $this->ProviderRepository = $ProviderRepository;
    }





    public function updateShopAndUserName(ShopDetailsFormRequest $request)
    {
        $details = $request->input();
        $user = Auth::user();
        $this->ProviderRepository->updateShopDetails($details,$user->id);
        $user->user_name = $details['user_name'];
        $user->save();
        return $this->successResponse('updated successful',200);
    }
}
