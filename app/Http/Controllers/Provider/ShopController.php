<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\UpdateShopDetailsFormRequest;
use App\Http\Requests\Provider\WorkingHourRequest;
use App\Http\Requests\ShopBranchFormRequest;
use App\Http\Requests\ShopDetailsFormRequest;
use App\Http\Resources\provider\openingTimeResource;
use App\Interfaces\ProviderInterface;
use App\Models\providerShopBranch;
use App\Models\ProviderShopDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{

    /**
     * Undocumented variable
     *
     * @var ProviderInterface
     */
    private ProviderInterface $ProviderRepository;

    /***
     *
     */


    public function __construct(ProviderInterface $ProviderRepository)
    {
        $this->ProviderRepository = $ProviderRepository;
    }


    /**
     * Undocumented function
     *
     * @param ShopDetailsFormRequest $request
     * @return void
     */
    public function createShopDetails(ShopDetailsFormRequest $request)
    {

        $provider_id = Auth::user()->id;
        $details = $request->input();
        $details['provider_id'] = $provider_id;
        $data = $this->ProviderRepository->createShopDetails($details);
        return $this->dataResponse(['shop' => $data], 'created successful', 200);
    }


    public function updateShopDetails(UpdateShopDetailsFormRequest $request)
    {
        $provider_id = Auth::user()->id;
        $details = $request->validated();
        $this->ProviderRepository->updateShopDetails($details, $provider_id);
        return $this->successResponse('updated successful', 200);
    }


    public function addWorkingHoursToShop(WorkingHourRequest $request)
    {

        $details = $request->validated();
        $auth = auth('provider')->user()->providerShopDetails->id;
        $branch = providerShopBranch::where('shop_id', $auth)->first();
        if (isset($details['working_hours_day'])) {
            $details['working_hours_day'] = json_encode($details['working_hours_day']);
        }

        $branch->update($details);
        return $this->successResponse('added successful', 200);

    }


    public function openingTime(){
        $auth = auth('provider')->user()->providerShopDetails->id;
        $branch = providerShopBranch::where('shop_id', $auth)->first();
        return $this->dataResponse(['opening_time'=>new openingTimeResource($branch)],'success',200);
    }

    public function getShopDetails()
    {
        $provider_id = Auth::user()->id;
        return $this->dataResponse(['shop' => $this->ProviderRepository->getShopDetails($provider_id)], 'success', 200);
    }

    public function getShopByCategoryId($id, Request $request)
    {
        return $this->paginateCollection($this->ProviderRepository->getShopByCategoryId($id, $request), $request->limit, 'shop');
    }
}
