<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProvderSignUpFormRequest;
use App\Http\Requests\ProviderLoginFormRequest;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Undocumented function
     *
     * @param ProvderSignUpFormRequest $request
     * @return void
     */
    public function signUp(Request $request)
    {
        $data = $request->input();
        $data['password'] = bcrypt($data['password']);
        $user = Provider::create($data);
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
        $credentials = $request->only('email', 'password');
        if (Auth::guard('provider')->attempt($credentials)) {
            $auth = Auth::guard('provider')->user();
            $token = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            return response()->json(['provider' => $auth, "token" => $token], 200);
        } else {
            return $this->errorResponse('Credentials not match', 401);
        }
    }
    
}
