<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\BundelFormRequest;
use App\Http\Resources\Provider\BundelResource;
use App\Http\Resources\Provider\BundelsResource;
use App\Interfaces\BundelInterface;
use App\Models\Bundel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BundelController extends Controller
{
    /**
     * Private variable
     *
     * @var BundelInterface
     */
    private BundelInterface $bundelInterface;

    /**
     * Bundel
     *
     * @param BundelInterface $bundelInterface
     */
    public function __construct(BundelInterface $bundelInterface)
    {
        $this->bundelInterface = $bundelInterface;
    }

    /**
     * List Bundek function
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $bundels = $this->bundelInterface->getAllShopBundel($request);
        return $this->paginateCollection(BundelsResource::collection($bundels),$request->limit,'budnel');

    }

    /**
     * Single Bundel function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function show(Request $request, $bundelID)
    {
        $bundel = $this->bundelInterface->getBundelById($bundelID, $request);
        return $this->dataResponse(['data' => new BundelResource($bundel)], 'OK', 200);
    }


    /**
     * Create Bundel function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function store(BundelFormRequest $bundel)
    {
        $auth_id = Auth::user()->providerShopDetails->id;
        $details=$bundel->validated();
        $details['shop_id']=$auth_id;
        $shopCollection = $this->bundelInterface->createShopBundel($details);
        return $this->dataResponse(['data' => new BundelResource($shopCollection)], 'OK', 200);
    }

    /**
     * Update Single Bundel function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(BundelFormRequest $bundel, $bundelID)
    {
        $shopBundel = $this->bundelInterface->updateShopBundel($bundelID, $bundel->validated());
        return $this->dataResponse(['data' => new BundelResource($shopBundel)], 'Updated Successfully', 200);
    }


    /**
     * Delete Single Bundel function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function destroy($bundelId)
    {
        $this->bundelInterface->deleteShopBundel($bundelId);
        return $this->successResponse('Deleted Successfuly', 200);
    }

    /**
     * Order Bundels
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderBundel(Request $request)
    {
        $data = $request->data;

        $ids = $request->value;
        $startIndex = ($request->page - 1) * $request->length;

        for ($i = $startIndex + 1; $i <= $request->length; $i++) {
            if ($i < count($request->value)) {
                $row = Bundel::findOrFail($ids[$i - 1]);
                if ($row) {
                    $row->update(['order' => $i]);
                }
            } else {

                $row = Bundel::findOrFail($ids[$i - 1]);
                if ($row) {
                    $row->update(['order' => $i]);
                }
                break;
            }
        }
        return $this->successResponse();
    }
}
