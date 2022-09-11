<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminFormRequest;
use App\Http\Requests\Admin\AdminLoginFormRequest;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function signUp(AdminFormRequest $request)
    {

        $data = $request->input();
        $data['password'] = bcrypt($data['password']);
        $admin = Admin::create($data);

        $token = $admin->createToken('AdminToken')->plainTextToken;

        return $this->dataResponse(['admin' => $admin, 'token' => $token], 'success', 200);
    }


    public function login(AdminLoginFormRequest $request)
    {

        $admin = Admin::where('email', $request->email)->first();


        if (!$admin || !Hash::check($request->password, $admin->password)) {

            return $this->errorResponseWithMessage('Credentials not match', 401);
        }

        $token = $admin->createToken('AdminToken')->plainTextToken;
        return $this->dataResponse(['admin' => $admin, 'token' => $token], 'success', 200);
    }



    public function ChangePassword(ChangePasswordFormRequest $request)
    {
        $admin = Auth::user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return $this->errorResponseWithMessage('Current password does not match!', 400);
        }
        $admin->password = bcrypt($request->password);
        $admin->save();
        return $this->successResponse();
    }

    
}
