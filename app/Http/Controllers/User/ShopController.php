<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\ProviderInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    private ProviderInterface $ProviderRepository;

    public function __construct(ProviderInterface $ProviderRepository)
    {
        $this->ProviderRepository = $ProviderRepository;
    }


    public function getShopByCategoryId($id, Request $request)
    {
        return $this->ProviderRepository->getShopByCategoryId($id, $request);
    }
}
