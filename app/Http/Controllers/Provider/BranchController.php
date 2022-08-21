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
        return $this->successResponse();
    }
}
