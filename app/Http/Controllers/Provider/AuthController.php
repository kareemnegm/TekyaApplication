<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\ProvderSignUpFormRequest;
use App\Http\Requests\ProviderLoginFormRequest;
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
        ProviderShopDetails::create($data);
        $token = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        return $this->dataResponse(['data' => $user, 'token' => $token], 'success', 201);
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

        if (!$provider || !Hash::check($request->password, $provider->password)) {

            return $this->errorResponse('Credentials not match', 401);
        }

        $token = $provider->createToken('LaravelSanctumAuth')->plainTextToken;
        return response()->json(['provider' => $provider, "token" => $token], 200);
    }


    public function ChangePassword(ChangePasswordFormRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse('Current password does not match!', 400);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->successResponse('updated successful',200);
    }

}
