<?php

namespace App\Repositories\User;

use App\Http\Resources\User\MyAddressesResource;
use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserLocation;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface
{
    public function addAddress($data)
    {

        UserAddress::create($data);
    }
    public function updateAddress($data, $id)
    {
        $address = UserAddress::find($id);
        $address->update($data);
    }

    public function deleteAddress($id)
    {
        $address = UserAddress::find($id);
        $address->delete();
    }

    public function getAddresses($data)
    {
        $limit = $data->limit?$data->limit:10;
        $address = UserAddress::where('user_id', $data['user_id'])->paginate($limit);
        return MyAddressesResource::collection($address);
    }


    public function createUserLocation($data)
    {
        return UserLocation::updateOrCreate(['user_id' => $data['user_id']], $data);
    }


    public function gerUserLocation($user_id)
    {
        return UserLocation::where('user_id', $user_id)->first();
    }


    /**
     * Delete User Account Function function
     *
     * @return boolean
     */
    public function deleteUser()
    {
        $userId=auth()->user()->id;
        return User::findOrFail($userId)->delete();
    }


    public function myProfile($user_id)
    {
        return User::where('id', $user_id)->first();

    }


}
