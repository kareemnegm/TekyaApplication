<?php

namespace App\Repositories\User;

use App\Http\Resources\User\MyAddressesResource;
use App\Interfaces\User\UserInterface;
use App\Models\UserAddress;
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
        $limit = $data['limit'] ? $data['limit'] : 10;
        $address = UserAddress::where('user_id', $data['user_id'])->paginate($limit);
        return MyAddressesResource::collection($address);
    }

}
