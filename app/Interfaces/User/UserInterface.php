<?php

namespace App\Interfaces\User;

interface UserInterface
{

    public function addAddress($data);
    public function updateAddress($data, $id);
    public function deleteAddress($id);
    public function getAddresses($data);

}
