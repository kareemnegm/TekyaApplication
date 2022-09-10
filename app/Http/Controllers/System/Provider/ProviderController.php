<?php

namespace App\Http\Controllers\System\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProviderShopFormRequest;
use App\Http\Requests\ProvderSignUpFormRequest;
use App\Http\Requests\Provider\UpdateShopDetailsFormRequest;
use App\Interfaces\ProviderInterface;
use App\Models\Provider;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{



    public function createProvider(ProviderShopFormRequest $request)
    {
        $data = $request->input();
        $data['admin_id'] = Auth::user()->id;
        $data['type'] = 'shop';
        $data['password'] = bcrypt('123456789');
        $user = Provider::create($data);
        $data['provider_id'] = $user->id;
        $data['status'] = 'approved';
        $shop = ProviderShopDetails::create($data);
        $shop_categories=$shop->category()->sync($data['category_id']);
        return $this->dataResponse(['provider' => $user, 'shop_name' => $shop], 'success', 200);
    }
}
