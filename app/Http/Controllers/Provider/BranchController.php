<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\BranchIdFormRequest;
use App\Http\Requests\ShopBranchFormRequest;
use App\Http\Resources\Provider\ShopBranchResource;
use App\Interfaces\ProviderInterface;
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
        $address = $this->ProviderRepository->BranchAddress($details);
        $details['branch_address_id'] = $address->id;
        $branch =   $this->ProviderRepository->createBranch($details);
        return $this->dataResponse(['branch' => new ShopBranchResource($branch)], 'created successful', 200);
    }

    public function getBranches(Request $request)
    {
        $shop_id = Auth::user()->providerShopDetails->value('id');
        return $this->paginateCollection(ShopBranchResource::collection($this->ProviderRepository->getBranches($shop_id, $request)), $request->limit, 'branch');
    }

    public function getBranch(BranchIdFormRequest $request)
    {
        return $this->paginateCollection(ShopBranchResource::collection($this->ProviderRepository->getBranch($request)), $request->limit, 'branch');
    }

    public function updateBranch(Request $request, $id)
    {
        $details = $request->input();
        $data = $this->ProviderRepository->updateBranch($details, $id);
        return $this->dataResponse(['branch' => $data], 'update successful', 200);
    }

    public function deleteBranch($id)
    {
        $this->ProviderRepository->deleteBranch($id);
        return $this->successResponse('deleted successful', 200);
    }
}
