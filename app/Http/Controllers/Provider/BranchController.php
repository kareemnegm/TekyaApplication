<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\Branch\BranchIdFormRequestDelPickUP;
use App\Http\Requests\Provider\BranchActiveFormRequest;
use App\Http\Requests\Provider\BranchIdFormRequest;
use App\Http\Requests\ShopBranchFormRequest;
use App\Http\Requests\UpdateShopBranchFormRequest;
use App\Http\Resources\Provider\ProductBranch\BranchResource;
use App\Http\Resources\Provider\ShopBranchResource;
use App\Interfaces\ProviderInterface;
use App\Models\BranchAddress;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{

    /**
     * Undocumented variable
     *
     * @var ProviderInterface
     */
    private ProviderInterface $ProviderRepository;
    /**
     * Undocumented function
     *
     * @param ProviderInterface $ProviderRepository
     */
    public function __construct(ProviderInterface $ProviderRepository)
    {
        $this->ProviderRepository = $ProviderRepository;
    }

    public function createBranch(ShopBranchFormRequest $request)
    {
        $provider_id = Auth::user()->id;
        $shopDetails = ProviderShopDetails::where('provider_id', $provider_id)->first();
        $details = $request->input();
        $details['shop_id'] = $shopDetails['id'];
        $branch =   $this->ProviderRepository->createBranch($details);
        return $this->dataResponse(['branch' => new ShopBranchResource($branch)], 'created successful', 200);
    }


    public function removePaymentOptionFromBranch(Request $request, $id)
    {
        $provider_id = Auth::user()->id;
        $shopDetails = ProviderShopDetails::where('provider_id', $provider_id)->first();
        $branch = providerShopBranch::findOrFail($id);
        if ($branch->shop_id == $shopDetails['id']) {
            $branch->paymentOption()->detach($request->payment_option_id);
            return $this->successResponse('removed successful', 200);
        }
        return $this->errorResponseWithMessage('Unauthorized', 401);
    }

    public function getBranches(Request $request)
    {
        $shop_id = Auth::user('provider')->providerShopDetails->id;
        return $this->paginateCollection(ShopBranchResource::collection($this->ProviderRepository->getBranches($shop_id, $request)), $request->limit, 'branch');
    }

    public function getBranchesForStocks(Request $request)
    {
        $shop_id = Auth::user()->providerShopDetails->id;
        return $this->dataResponse([BranchResource::collection($this->ProviderRepository->getBranches($shop_id, $request))], 'success', 200);
    }

    public function getBranch(BranchIdFormRequest $request)
    {
        return $this->dataResponse(['branch' => new ShopBranchResource($this->ProviderRepository->getBranch($request))], 'success', 200);
    }

    public function updateBranch(UpdateShopBranchFormRequest $request, $id)
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


    public function branchActive(BranchActiveFormRequest $request)
    {
        $data = $request->validated();
        providerShopBranch::where('id', $data['branch_id'])->update(['is_active' => $data['is_active']]);
        return $this->successResponse('updated successful', 200);
    }



    public function branchDeliveryPickUpToggle(BranchIdFormRequestDelPickUP $request)
    {
        $this->ProviderRepository->branchDeliveryPickUpToggle($request->validated());
        return $this->successResponse('updated successful', 200);
    }
}
