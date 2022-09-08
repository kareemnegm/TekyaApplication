<?php

namespace App\Http\Controllers\System\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\UpdateShopDetailsFormRequest;
use App\Interfaces\ProviderInterface;
use App\Models\Provider;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{



    public function createProvider(Request $request)
    {
        $data = $request->input();
        $data['admin_id'] = Auth::user()->id;
        $data['password'] = bcrypt($data['password']);
        $user = Provider::create($data);
        $data['provider_id'] = $user->id;
        $data['status'] = 'approved';

        $shop = ProviderShopDetails::create($data);
        return $this->dataResponse(['provider' => $user, 'shop_name' => $shop->shop_name], 'success', 200);
    }
}
