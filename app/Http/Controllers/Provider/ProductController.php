<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\ProductFormRequest;
use App\Http\Resources\Provider\ProductResource;
use App\Http\Resources\Provider\ProductsResource;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductInterface $productInterface;

    /**
     * Undocumented function
     *
     * @param ProductInterface $productInterface
     */
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }


    /**
     * List Collection function
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request,$collection_id)
    {
        $products=$this->productInterface->getAllShopProduct($request,$collection_id);
        return ProductsResource::collection($products);
    }

     /**
     * Single Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function show(Request $request,$collectionId)
    {
        $projects=$this->productInterface->getProductById($collectionId,$request);
        return $this->dataResponse(['data'=>New ProductResource($projects)],'OK',200);
    }


     /**
     * Create Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function store(ProductFormRequest $bundel)
    {
        $shopCollection=$this->productInterface->createShopProduct($bundel->validated());
        return $this->dataResponse(['data'=>New ProductResource($shopCollection)],'OK',200);
    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(ProductFormRequest $product,$productId)
    {
        $shopProduct=$this->productInterface->updateShopProduct($productId,$product->validated());
        return $this->dataResponse(['data'=>$shopProduct],'Updated Successfully',200);
    }

     /**
     * Delete Single Collection function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function destroy($productId)
    {
        $this->productInterface->deleteShopProduct($productId);
        return $this->successResponse('Deleted Successfuly',200);

    }

}
