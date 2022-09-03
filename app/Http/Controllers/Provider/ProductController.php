<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\ProductFormRequest;
use App\Http\Requests\Provider\ProductIdsFormRequest;
use App\Http\Resources\Provider\ProductResource;
use App\Http\Resources\Provider\ProductsResource;
use App\Interfaces\ProductInterface;
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
    public function index(Request $request, $collection_id)
    {
        $products = $this->productInterface->getAllShopProduct($request, $collection_id);
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
        $projects = $this->productInterface->getProductById($collectionId, $request);
        return $this->dataResponse(['product' => new ProductResource($projects)], 'OK', 200);
    }


    /**
     * Create Product function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function store(ProductFormRequest $bundel)
    {
        $shopCollection = $this->productInterface->createShopProduct($bundel->validated());
        return $this->dataResponse(['product' => new ProductResource($shopCollection)], 'created successful', 200);
    }

    /**
     * Update Single Project function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function update(ProductFormRequest $product, $productId)
    {
        $shopProduct = $this->productInterface->updateShopProduct($productId, $product->validated());
        return $this->dataResponse(['product' => new ProductResource($shopProduct)], 'Updated Successfully', 200);
    }

    /**
     * Delete Single Product function
     *
     * @param [type] $projectId
     * @return Object
     */
    public function destroy($productId)
    {
        $this->productInterface->deleteShopProduct($productId);
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
        $this->productInterface->deleteShopProduct($productId);
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


    public function remove_product_from_collection(ProductIdsFormRequest $request)
    {
        $products = $request->product_ids;
        $this->productInterface->remove_product_from_collection($products);
        return $this->successResponse('removed Successfully', 200);
    }


    public function move_product_from_collection(ProductIdsFormRequest $request)
    {
        $products = $request->product_ids;
        $collection_id = $request->collection_id;
        $this->productInterface->move_product_from_collection($products, $collection_id);
        return $this->successResponse('moved Successfully', 200);
    }
}
