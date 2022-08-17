<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvderSignUpFormRequest;
use App\Http\Requests\ProviderLoginFormRequest;
use App\Http\Requests\ShopBranchFormRequest;
use App\Http\Requests\ShopDetailsFormRequest;
use App\Interfaces\ProviderInterface;
use App\Models\PaymentOption;
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



    public function signUp(ProvderSignUpFormRequest $request)
    {
        $data = $request->input();
        $data['password'] = bcrypt($data['password']);
        $user = Provider::create($data);
        $token = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        return $this->dataResponse(['data' => $user, 'token' => $token], 'success', 201);
    }



    public function login(ProviderLoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('provider')->attempt($credentials)) {
            $auth = Auth::guard('provider')->user();
            $token = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            return response()->json(['provider' => $auth, "token" => $token], 200);
        } else {
            return $this->errorResponse('Credentials not match', 401);
        }
    }


    // 3ayzaa tetzbaat mn n7yt el guards
    public function createShopDetails(ShopDetailsFormRequest $request)
    {
        $provider_id = Auth::user()->id;
        $details = $request->input();
        $details['provider_id'] = $provider_id;
        $this->ProviderRepository->createShopDetails($details);
        return $this->successResponse();
    }

    public function createBranch(ShopBranchFormRequest $request)
    {
        $provider_id = Auth::user()->id;
        $shopDetails = ProviderShopDetails::where('provider_id', $provider_id)->first();
        $details = $request->input();
        $details['provider_shop_details_id'] = $shopDetails->id;
        $branch = $this->ProviderRepository->createBranch($details);
        $details['provider_shop_branch_id'] = $branch->id;
        $this->ProviderRepository->BranchAddress($details);
        return $this->successResponse();
    }


    /**!payment section  */
    public function createPaymentOption(Request $request)
    {
        PaymentOption::create([
            'name' => $request->name
        ]);
        return $this->successResponse();
    }

    /**!end of payment section  */
}
