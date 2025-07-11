<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAddressFormRequest;
use App\Http\Requests\User\UserLocationFormRequest;
use App\Http\Resources\User\UserAddressResource;
use App\Http\Resources\User\UserProfileResource;
use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserInterface $UserRepository;

    public function __construct(UserInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function createAddress(UserAddressFormRequest $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->input();
        $data['user_id'] = $user_id;
        $this->UserRepository->addAddress($data);
        return $this->successResponse('created successfully', 200);
    }

    public function updateAddress(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $address = UserAddress::where('id', $id)->where('user_id', $user_id)->exists();
        if ($address) {
            $data = $request->input();
            $data['user_id'] = $user_id;
            $this->UserRepository->updateAddress($data, $id);
            return $this->successResponse('updated successfully', 200);
        }
        return $this->errorResponseWithMessage('unauthorized', 401);
    }

    public function deleteAddress($id)
    {
        $user_id = Auth::user()->id;
        $address = UserAddress::where('id', $id)->where('user_id', $user_id)->exists();
        if ($address) {
            $this->UserRepository->deleteAddress($id);
            return $this->successResponse('deleted successfully', 200);
        }
        return $this->errorResponseWithMessage('unauthorized', 401);
    }

    public function getAddresses(Request $request)
    {
        $data = $request;
        $user_id = Auth::user()->id;
        $data['user_id'] = $user_id;
        return $this->UserRepository->getAddresses($data);
    }

    public function getAddress($id)
    {
        $user_id = Auth::user()->id;
        $address = UserAddress::where('id', $id)->where('user_id', $user_id)->first();
        if (isset($address) && !empty($address)) {
            return $this->dataResponse(['data' => new UserAddressResource($address)], 'ok', 200);
        }
        return $this->errorResponseWithMessage('unauthorized', 401);
    }


    public function createUserLocation(UserLocationFormRequest $request)
    {
        $data = $request->input();
        $data['user_id'] = Auth::user()->id;
        $this->UserRepository->createUserLocation($data);
        return $this->successResponse();
    }


    public function getUserLocation()
    {
        $user_id = Auth::user()->location()->first();

        return $user_id;
    }


    /**
     * Delete User Account SoftDelete function
     *
     * @return object
     */
    public function deleteUserAccount()
    {
        $this->UserRepository->deleteUser();
        return $this->successResponse('delete successfully', 200);
    }



    public function myProfile()
    {

        $user = $this->UserRepository->myProfile(Auth::user()->id);
        return $this->dataResponse(['my_profile' => new UserProfileResource($user)], 'success', 200);
    }
}
