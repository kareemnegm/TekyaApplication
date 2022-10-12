<?php

namespace App\Http\Controllers\System\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProviderCreateFormRequest;
use App\Http\Requests\Admin\ProviderShopFormRequest;
use App\Http\Requests\ProvderSignUpFormRequest;
use App\Http\Requests\Provider\UpdateShopDetailsFormRequest;
use App\Http\Resources\Admin\ProviderResource;
use App\Interfaces\ProviderInterface;
use App\Models\Provider;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{



    public function createProvider(ProviderCreateFormRequest $request)
    {
        $data = $request->input();
        $data['admin_id'] = Auth::user()->id;
        $data['type'] = 'shop';
        $data['password'] = bcrypt($data['password']);
        $user = Provider::create($data);
        return $this->dataResponse(['provider' => $user], 'success', 200);
    }


    public function getAllProviders(Request $request){
        return $this->paginateCollection(ProviderResource::collection(Provider::orderBy('id','desc')->get()), $request->limit, 'providers');

    }


}
