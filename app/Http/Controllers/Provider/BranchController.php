<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopBranchFormRequest;
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
        $details['provider_shop_details_id'] = $shopDetails->id;
        $branch = $this->ProviderRepository->createBranch($details);
        $details['provider_shop_branch_id'] = $branch->id;
        $this->ProviderRepository->BranchAddress($details);
        return $this->successResponse('created successfully', 201);
    }

    public function getBranches()
    {
        $shop_id = Auth::user()->providerShopDetails->value('id');
        return $this->dataResponse(['data'=>$this->ProviderRepository->getBranches($shop_id)],'success',200);

    }

    public function updateBranch(Request $request, $id)
    {
        $details = $request->input();
        $this->ProviderRepository->updateBranch($details, $id);
        return $this->successResponse('updated successfully', 200);
    }

    public function deleteBranch($id)
    {
        $this->ProviderRepository->deleteBranch($id);
        return $this->successResponse('deleted successful', 200);
    }
}
