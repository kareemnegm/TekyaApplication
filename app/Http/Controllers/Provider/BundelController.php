<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\BundelFormRequest;
use App\Http\Resources\Provider\BundelResource;
use App\Http\Resources\Provider\BundelsResource;
use App\Interfaces\BundelInterface;
use Illuminate\Http\Request;

class BundelController extends Controller
{
    private BundelInterface $bundelInterface;

    /**
     * Undocumented function
     *
     * @param BundelInterface $bundelInterface
     */
    public function __construct(BundelInterface $bundelInterface)
    {
        $this->bundelInterface = $bundelInterface;
    }


    /**
     * List Collection function
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $bundels=$this->bundelInterface->getAllShopBundel($request);
        return $this->dataResponse(['data'=>BundelsResource::collection($bundels)],'OK',200);
    }

     /**
     * Single Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function show(Request $request,$collectionId)
    {
        $projects=$this->bundelInterface->getBundelById($collectionId,$request);
        return $this->dataResponse(['data'=>New CollectionResource($projects)],'OK',200);
    }


     /**
     * Create Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function store(BundelFormRequest $bundel)
    {
        $shopCollection=$this->bundelInterface->createShopBundel($bundel->validated());
        return $this->dataResponse(['data'=>New BundelResource($shopCollection)],'OK',200);
    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(BundelFormRequest $bundel,$bundelID)
    {
        $shopBundel=$this->bundelInterface->updateShopBundel($bundelID,$bundel->validated());
        return $this->dataResponse(['data'=>$shopBundel],'Updated Successfully',200);
    }

}
