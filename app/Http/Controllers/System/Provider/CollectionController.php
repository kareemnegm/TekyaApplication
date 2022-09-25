<?php

namespace App\Http\Controllers\System\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CollectionUpdatedFormRequest;
use App\Http\Requests\Admin\CollectionFormRequest;
use App\Http\Requests\Admin\CollectionSearchFormRequest;
use App\Http\Requests\Admin\CollectionShopIdFormRequest;
use App\Http\Resources\Admin\CollectionResource;
use App\Http\Resources\Admin\CollectionSearchResource;
use App\Http\Resources\Admin\CollectionsResource;
use App\Interfaces\Admin\CollectionInterface;
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
    public function index(CollectionShopIdFormRequest $request)
    {
        $projects = $this->collectionInterface->getAllAdminShopCollection($request);
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
        $projects = $this->collectionInterface->getAdminCollectionById($collectionId, $request);
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
        $shopCollection = $this->collectionInterface->createAdminShopCollection($collection->validated());
        return $this->dataResponse(['collection' => new CollectionResource($shopCollection)], 'created successful', 200);
    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(CollectionFormRequest $collection, $collectionID)
    {
        $collection = $this->collectionInterface->updateAdminShopCollection($collectionID, $collection->validated());
        return $this->dataResponse(['collection' => new CollectionResource($collection)], 'Updated Successfully', 200);
    }

    /**
     * Delete Single Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function destroy(Request $request, $collectionID)
    {
        $this->collectionInterface->deleteAdminShopCollection($collectionID);
        return $this->successResponse('Deleted Successfuly', 200);
    }

    /**
     * CollectionUpdatedFormRequest function
     *
     * @param CollectionUpdatedFormRequest $request
     * @return void
     */
    public function renameCollection(CollectionUpdatedFormRequest $request)
    {
        $details = $request->validated();
        $data = $this->collectionInterface->renameAdminCollection($details);
        return $this->dataResponse(['collection' => new CollectionResource($data)], 'Updated Successfully', 200);
    }
    /**
     * CollectionUpdatedFormRequest function
     *
     * @param CollectionUpdatedFormRequest $request
     * @return void
     */
    public function changeStatusCollection(CollectionUpdatedFormRequest $request)
    {
        $details = $request->validated();
        $data = $this->collectionInterface->publishAdminCollection($details);
        return $this->dataResponse(['collection' => new CollectionResource($data)], 'Updated Successfully', 200);
    }


    public function collectionSearch(CollectionSearchFormRequest $request)
    {
        $search = $request->validated();
        $collectionSearch = Collection::where('shop_id', $search['shop_id']);
        if (isset($search['keyWord']) && !empty($search['keyWord'])) {
            $collectionSearch = $collectionSearch->where('name', 'LIKE', '%' . $search['keyWord'] . '%');
        }
        $collectionSearch = $collectionSearch->get();

        return $this->paginateCollection(CollectionSearchResource::collection($collectionSearch), $request->limit, 'collection');
    }
}
