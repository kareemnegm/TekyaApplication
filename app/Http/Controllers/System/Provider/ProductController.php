<?php

namespace App\Http\Controllers\System\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminProductFormRequest;
use App\Http\Requests\Admin\AdminProductIdsFormRequest;
use App\Http\Requests\Admin\AdminProductStatusFormRequest;
use App\Http\Requests\Provider\Product\ProductSortFormRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Http\Resources\Admin\ProductsResource;
use App\Interfaces\Admin\ProductInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Private variable
     *
     * @var ProductInterface
     */
    private ProductInterface $productInterface;

    /**
     * Product function
     *
     * @param ProductInterface $productInterface
     */
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
    }


    /**
     * List Product function
     *
     * @param Request $request
     * @return array
     */
    public function index(ProductSortFormRequest $request, $collection_id)
    {
        $products = $this->productInterface->getAllAdminShopProduct($request, $collection_id);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'product');
    }

    /**
     * Single Product function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function show(Request $request, $collectionId)
    {
        $projects = $this->productInterface->getAdminProductById($collectionId, $request);
        return $this->dataResponse(['product' => new ProductResource($projects)], 'OK', 200);
    }


    /**
     * Create Product function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function store(AdminProductFormRequest $bundel)
    {
        $shopCollection = $this->productInterface->createAdminShopProduct($bundel->validated());
        return $this->dataResponse(['product' => new ProductResource($shopCollection)], 'created successful', 200);
    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(AdminProductFormRequest $product, $productId)
    {
        $shopProduct = $this->productInterface->updateAdminShopProduct($productId, $product->validated());
        return $this->dataResponse(['product' => new ProductResource($shopProduct)], 'Updated Successfully', 200);
    }

    /**
     * Delete Single Product function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function destroy(AdminProductIdsFormRequest $request,$id)
    {
        // dd();
        $this->productInterface->deleteAdminShopProduct($request->product_id);
        return $this->successResponse('Deleted Successfuly', 200);
    }

    /**
     * Delete Single Product function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function shopProduct($productId)
    {
        $this->productInterface->adminRemoveProductCollection($productId);
        return $this->successResponse('Deleted Successfuly', 200);
    }

    /**
     * Order Products
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderProduct(Request $request)
    {
        $data = $request->data;

        $ids = $request->value;
        $startIndex = ($request->page - 1) * $request->length;

        for ($i = $startIndex + 1; $i <= $request->length; $i++) {
            if ($i < count($request->value)) {
                $row = Product::findOrFail($ids[$i - 1]);
                if ($row) {
                    $row->update(['order' => $i]);
                }
            } else {

                $row = Product::findOrFail($ids[$i - 1]);
                if ($row) {
                    $row->update(['order' => $i]);
                }
                break;
            }
        }
        return $this->successResponse();
    }

    /**
     * Undocumented function
     *
     * @param AdminProductIdsFormRequest $request
     * @return void
     */
    public function adminRemoveProductCollection(AdminProductIdsFormRequest $request)
    {
        $products = $request->input();
        $data = $this->productInterface->adminRemoveProductCollection($products);
        $this->dataResponse(['product' =>  ProductResource::collection($data)], 'removed Successfully', 200);
    }


    /**
     * Undocumented function
     *
     * @param AdminProductIdsFormRequest $request
     * @return void
     */
    public function moveAdminProductFromCollection(AdminProductIdsFormRequest $request)
    {
        $products = $request->product_id;
        $collection_id = $request->collection_id;
        $data = $this->productInterface->moveAdminProductFromCollection($products, $collection_id);
        $this->dataResponse(['product' =>  ProductResource::collection($data)], 'moved Successfully', 200);
    }

    /**
     * Undocumented function
     *
     * @param AdminProductStatusFormRequest $request
     * @return void
     */
    public function publishAdminProduct(AdminProductStatusFormRequest $request)
    {
        $productDetails = $request->input();
        $this->productInterface->publishAdminProduct($productDetails);
        
        if($productDetails['is_published'] == 0){

            return $this->successResponse('product unpublished', 200);

           }elseif ($productDetails['is_published'] == 1){

            return $this->successResponse('product published', 200);
        }
    }
}
