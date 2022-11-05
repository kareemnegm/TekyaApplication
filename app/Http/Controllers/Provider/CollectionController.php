<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\CollectionFormRequest;
use App\Http\Requests\Provider\CollectionUpdateFormRequest;
use App\Http\Requests\Provider\UpdateCollectionFormRequest;
use App\Http\Resources\Provider\CollectionResource;
use App\Http\Resources\Provider\CollectionsResource;
use App\Interfaces\CollectionInterface;
use App\Models\Collection;
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
        $projects = $this->collectionInterface->getAllShopCollection($request);
        return $this->paginateCollection(CollectionsResource::collection($projects), $request->limit, 'collection');
    }

    /**
     * Single Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function show(Request $request, $collectionId)
    {
        $projects = $this->collectionInterface->getCollectionById($collectionId, $request);
        return $this->dataResponse(['collection' => new CollectionResource($projects)], 'OK', 200);
    }


    /**
     * Create Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function store(CollectionFormRequest $collection)
    {
        $shopCollection = $this->collectionInterface->createShopCollection($collection->validated());
        return $this->dataResponse(['collection' => new CollectionResource($shopCollection)], 'created successful', 200);
    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(UpdateCollectionFormRequest $collection, $collectionID)
    {
        $authShop=auth('provider')->user()->providerShopDetails->id;
         Collection::where('id',$collectionID)->where('shop_id',$authShop)->firstOrFail();
        $collection = $this->collectionInterface->updateShopCollection($collectionID, $collection->validated());
        return $this->dataResponse(['collection' => new CollectionResource($collection)], 'Updated Successfully', 200);
    }

    /**
     * Delete Single Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function destroy($collectionID)
    {
        $this->collectionInterface->deleteShopCollection($collectionID);
        return $this->successResponse('Deleted Successfuly', 200);
    }

    public function rename(CollectionUpdateFormRequest $request)
    {
        $details = $request->validated();
       $data= $this->collectionInterface->rename($details);
        return $this->dataResponse(['collection' => new CollectionResource($data)], 'Updated Successfully', 200);

    }

    public function publish_unPublish(CollectionUpdateFormRequest $request)
    {
        $details = $request->validated();
        $data= $this->collectionInterface->publish_unPublish($details);
        return $this->dataResponse(['collection' => new CollectionResource($data)], 'Updated Successfully', 200);

    }
}
