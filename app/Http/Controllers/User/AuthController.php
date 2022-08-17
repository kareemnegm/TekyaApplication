<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserLoginFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function signUp(UserFormRequest $request)
    {
        $data = $request->input();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $token = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        return $this->dataResponse(['data' => $user, 'token' => $token], 'success', 201);
    }



    public function login(UserLoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $auth = Auth::user();
            $token = $auth->createToken('LaravelSanctumAuth')->plainTextToken;
            return response()->json(['user' => $auth, "token" => $token], 200);
        } else {
            return $this->errorResponse('Credentials not match', 401);
        }
    }

    public function ChangePassword(ChangePasswordFormRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse('Current password does not match!', 400);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->successResponse();
    }
}
