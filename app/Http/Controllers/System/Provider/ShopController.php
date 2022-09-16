<?php

namespace App\Http\Controllers\System\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProviderCreateFormRequest;
use App\Http\Requests\Admin\ProviderShopFormRequest;
use App\Http\Requests\Provider\BranchIdFormRequest;
use App\Http\Requests\Provider\UpdateShopDetailsFormRequest;
use App\Http\Requests\ShopBranchFormRequest;
use App\Http\Resources\Provider\ShopBranchResource;
use App\Http\Resources\Provider\ShopDetailsResource;
use App\Interfaces\Admin\ProviderInterface;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    private ProviderInterface $ProviderRepository;

    public function __construct(ProviderInterface $ProviderRepository)
    {
        $this->ProviderRepository = $ProviderRepository;
    }


    public function createShop(ProviderShopFormRequest $request)
    {
        $data = $request->input();
        $data['status'] = 'approved';
        $shop = ProviderShopDetails::create($data);
        $shop_categories = $shop->category()->sync($data['category_id']);
        return $this->dataResponse(['shop' => $shop], 'success', 200);
    }


    public function approverPendingStores($id)
    {
        $shop = ProviderShopDetails::find($id);
        $shop->update(['status' => 'approved']);
        return $this->successResponse('approved success', 200);
    }

    /***
     * @param $request , $id
     * update shop details
     */
    public function updateShopDetails(UpdateShopDetailsFormRequest $request, $id)
    {
        $details = $request->input();
        $details['admin_id'] = Auth::user()->id;
        $this->ProviderRepository->updateShopDetails($details, $id);
        return $this->successResponse('updated successful', 200);
    }


    /***
     * @param $request , $id
     * get shop details
     */
    public function getShopDetails($id)
    {

        return $this->dataResponse(['shop' => $this->ProviderRepository->getShopDetails($id)], 'success', 200);
    }



    public function getShops(Request $request)
    {
        return $this->paginateCollection(ShopDetailsResource::collection($this->ProviderRepository->getShops()), $request->limit, 'shops');
    }


    public function suspendShop($id)
    {
        $this->ProviderRepository->suspendShop($id);
        return $this->successResponse('shop suspended', 200);
    }



    /***
     * @param $request
     * create branch and branch address
     */

    public function createBranch(ShopBranchFormRequest $request)
    {
        $details = $request->input();
        $shopDetails = ProviderShopDetails::where('id', $details['shop_id'])->first();
        $details['shop_id'] = $shopDetails['id'];
        $address = $this->ProviderRepository->BranchAddress($details);
        $details['branch_address_id'] = $address->id;
        $branch =   $this->ProviderRepository->createBranch($details);
        return $this->dataResponse(['branch' => new ShopBranchResource($branch)], 'created successful', 200);
    }


    public function getBranches(Request $request, $id)
    {
        // $shop_id = $request->shop_id;
        return $this->paginateCollection(ShopBranchResource::collection($this->ProviderRepository->getBranches($id, $request)), $request->limit, 'branch');
    }


    public function getBranch($id)
    {
        return $this->dataResponse(['branch' => new ShopBranchResource($this->ProviderRepository->getBranch($id))], 'success', 200);
    }



    public function updateBranch(Request $request, $id)
    {
        $details = $request->input();
        $data = $this->ProviderRepository->updateBranch($details, $id);
        return $this->dataResponse(['branch' => new ShopBranchResource($data)], 'update successful', 200);
    }



    public function deleteBranch($id)
    {
        $this->ProviderRepository->deleteBranch($id);
        return $this->successResponse('deleted successful', 200);
    }
}
