<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\CollectionFormRequest;
use App\Http\Resources\Provider\CollectionResource;
use App\Http\Resources\Provider\CollectionsResource;
use App\Interfaces\CollectionInterface;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    private CollectionInterface $collectionInterface;

    /**
     * Undocumented function
     *
     * @param CollectionInterface $collectionInterface
     */
    public function __construct(CollectionInterface $collectionInterface)
    {
        $this->collectionInterface = $collectionInterface;
    }


    /**
     * List Collection function
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $projects=$this->collectionInterface->getAllShopCollection($request);
        return CollectionsResource::collection($projects);
    }

     /**
     * Single Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function show(Request $request,$collectionId)
    {
        $projects=$this->collectionInterface->getCollectionById($collectionId,$request);
        return $this->dataResponse(['data'=>New CollectionResource($projects)],'OK',200);
    }


     /**
     * Create Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function store(CollectionFormRequest $collection)
    {
        $shopCollection=$this->collectionInterface->createShopCollection($collection->validated());
        return $this->dataResponse(['data'=>New CollectionResource($shopCollection)],'OK',200);
    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(CollectionFormRequest $collection,$collectionID)
    {
        $collection=$this->collectionInterface->updateShopCollection($collectionID,$collection->validated());
        return $this->dataResponse(['data'=>New CollectionResource($collection)],'Updated Successfully',200);

    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function destory($collectionID)
    {
        $collection=$this->collectionInterface->deleteShopCollection($collectionID);
        return $this->successResponse('Deleted Successfuly',200);

    }

}
