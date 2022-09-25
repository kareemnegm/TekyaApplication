<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\User\AuthFormRequest;
use App\Http\Requests\User\UserAreaFormRequest;
use App\Http\Requests\User\UpdateUserFormRequest;
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

        $data = $request->all();

        $data['mobile'] = ltrim($data['mobile'], "0");

        $user = User::create($data);
    
        $token = $user->createToken('UserToken')->plainTextToken;

        Cart::create(['user_id' => $user->id]);

        return $this->dataResponse(['user' => $user,'complete_profile'=>false, 'token' => $token ], 'success', 200);
    }



    public function login(UserLoginFormRequest $request)
    {
        if (isset($request->email) && !empty($request->email)) {
            $user = User::where('email', $request->email)->first();

        } elseif (isset($request->mobile) && !empty($request->mobile)) {
            $user = User::where('mobile', $request->mobile)->first();
        }

        $token = $user->createToken('UserToken')->plainTextToken;

        if(isset($user->email)&&isset($user->first_name) && isset($user->last_name)){
             $complete_profile=true;
        }else{
            $complete_profile=false;
        }

        return $this->dataResponse(['user' => $user, 'complete_profile'=>$complete_profile,'token' => $token], 'success', 200);

    }


    /**
     * auth
     */
    public function authentication(AuthFormRequest $request)
    {
       
        $data = $request->validated();
        $user=User::where('mobile',$data['mobile'])->first();

        if(!$user){

        $data['mobile'] = ltrim($data['mobile'], "0");

        $user = User::create($data);
        $token = $user->createToken('UserToken')->plainTextToken;
        Cart::create(['user_id' => $user->id]);

        $message='Register Successfuly';
        }else{
            $token = $user->createToken('UserToken')->plainTextToken;
            $message='Login Successfuly';
        }

        if(isset($user->email)&&isset($user->first_name) && isset($user->last_name)){
             $complete_profile=true;
           }else{
             $complete_profile=false;
        }
        return $this->dataResponse(['user' => $user,'complete_profile'=>$complete_profile, 
        'token' => $token ], $message, 200);

    }
    public function ChangePassword(ChangePasswordFormRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponseWithMessage('Current password does not match!', 400);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return $this->successResponse();
    }

    /**
     * Undocumented function
     *
     * @param UserAreaFormRequest $request
     * @return void
     */
    public function userArea(UserAreaFormRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
        return $this->successResponse();
    }


    public function updateProfile(UpdateUserFormRequest $request)
    {
        $user = Auth::user();
        $user->update($request->input());
        return $this->successResponse('updated successful', 200);
    }


    public function testEmail(Request $request)
    {
        Mail::send(['html' => 'view_name'], $data, function ($m) use ($email) {
            $m->from('anwarsaeed1@yahoo.com', 'name');
            $m->to($email, $email)->subject('email subject');
        });
    }
  
}
