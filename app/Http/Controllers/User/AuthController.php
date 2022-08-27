<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\User\UserFormRequest;
use App\Http\Requests\User\UserLoginFormRequest;
use App\Models\Cart;
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
        Cart::create(['user_id' => $user->id]);
        return $this->dataResponse(['data' => $user, 'token' => $token], 'success', 201);
    }



    public function login(UserLoginFormRequest $request)
    {
        if (isset($request->email) && !empty($request->email)) {
            $user = User::where('email', $request->email)->first();
        } elseif (isset($request->mobile) && !empty($request->mobile)) {
            $user = User::where('mobile', $request->mobile)->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {

            return $this->errorResponse('Credentials not match', 401);
        }

        $token = $user->createToken('LaravelSanctumAuth')->plainTextToken;
        return $this->dataResponse(['user' => $user, 'token' => $token], 'success', 200);

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
