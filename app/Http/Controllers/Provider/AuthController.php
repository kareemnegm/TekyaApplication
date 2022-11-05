<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\ProvderSignUpFormRequest;
use App\Http\Requests\ProviderLoginFormRequest;
use App\Http\Requests\User\UpdateUserFormRequest;
use App\Models\Provider;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Undocumented function
     *
     * @param ProvderSignUpFormRequest $request
     * @return void
     */
    public function signUp(ProvderSignUpFormRequest $request)
    {

        $data = $request->input();
        $data['password'] = bcrypt($data['password']);
        $user = Provider::create($data);
        $data['provider_id'] = $user->id;
        $shop = ProviderShopDetails::create($data);
        $token = $user->createToken('ProviderToken')->plainTextToken;
        return $this->dataResponse(['provider' => $user, 'shop_name' => $shop->shop_name], 'success', 200);
    }


    /**
     * Undocumented function
     *
     * @param ProviderLoginFormRequest $request
     * @return void
     */
    public function login(ProviderLoginFormRequest $request)
    {

        $provider = Provider::where('email', $request->email)->first();
        if ($provider->approved == 0) {
            return $this->successResponse('account need to be approved', 422);
        }
        $shop_name = $provider->providerShopDetails()->value('shop_name');

        if (!$provider || !Hash::check($request->password, $provider->password)) {

            return $this->errorResponseWithMessage('Credentials not match', 401);
        }
        $token = $provider->createToken('ProviderToken')->plainTextToken;
        return $this->dataResponse(['provider' => $provider, 'shop_name' => $shop_name, 'token' => $token], 'success', 200);
    }


    public function ChangePassword(ChangePasswordFormRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponseWithMessage('Current password does not match!', 400);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->successResponse('updated successful', 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->successResponse(' success logged out', 200);
    }
}
