<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\CollectionSearchFormRequest;
use App\Http\Requests\Provider\Product\ProductSortFormRequest;
use App\Http\Requests\Provider\Product\ProductVariantFormRequest;
use App\Http\Requests\Provider\Product\VariantIdFormRequestDelete;
use App\Http\Requests\Provider\ProductFormRequest;
use App\Http\Requests\Provider\ProductIdsFormRequest;
use App\Http\Requests\Provider\ProductMoveCollectionFormRequest;
use App\Http\Requests\Provider\ProductPublishUnPublishFormRequest;
use App\Http\Requests\Provider\ProductSearchRequest;
use App\Http\Requests\Provider\ProductUpdateFormRequest;
use App\Http\Resources\Provider\CollectionsResource;
use App\Http\Resources\Provider\ProductBranchStockResource;
use App\Http\Resources\Provider\ProductResource;
use App\Http\Resources\Provider\ProductSearchResource;
use App\Http\Resources\Provider\ProductsResource;
use App\Http\Resources\Provider\VariantResource;
use App\Http\Resources\Provider\VariantValueResource;
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
    private $auth;
    /**
     * Product function
     *
     * @param ProductInterface $productInterface
     */
    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
        $this->auth = auth('provider')->user()->providerShopDetails->id;
    }

    /**
     * List Product function
     *2
     * @param Request $request
     * @return array
     */
    public function getAllShopProduct(ProductSortFormRequest $request)
    {
        $products = $this->productInterface->getAllShopProduct($request);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'product');
    }
    /**
     * List Product function
     *2
     * @param Request $request
     * @return array
     */
    public function index(ProductSortFormRequest $request, $collection_id)
    {
        $products = $this->productInterface->getAllShopCollectionProduct($request, $collection_id);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'product');
    }


    /**
     * List Product function
     *
     * @param Request $request
     * @return array
     */
    public function productsSearch(ProductSearchRequest $request)
    {
        $data = $request;
        $data['shop_id'] = $this->auth;
        $products = $this->productInterface->productsSearch($data);
        return $this->paginateCollection(ProductSearchResource::collection($products), $request->limit, 'product');
    }

    public function collectionSearch(CollectionSearchFormRequest $request)
    {
        $data = $request;
        $data['shop_id'] = $this->auth;
        $products = $this->productInterface->collectionSearch($data);
        return $this->paginateCollection(CollectionsResource::collection($products), $request->limit, 'collection');
    }


    public function productNotInCollectionSearch(ProductSearchRequest $request)
    {
        $data = $request->validated();
        $data['shop_id'] = $this->auth;
        $products = $this->productInterface->productNotInCollectionSearch($data);
        return $this->paginateCollection(ProductSearchResource::collection($products), $request->limit, 'product');
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
    public function update(ProductUpdateFormRequest $product, $productId)
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
    public function destroy(ProductIdsFormRequest $request)
    {
        // dd();
        $this->productInterface->deleteShopProduct($request->product_id);
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
        $products = $request->product_id;
        $data = $this->productInterface->remove_product_from_collection($products);
        return $this->successResponse('removed successful', 200);
    }


    public function move_product_from_collection(ProductMoveCollectionFormRequest $request)
    {
        $products = $request->product_id;
        $collection_id = $request->collection_id;
        $this->productInterface->move_product_from_collection($products, $collection_id);
        return $this->successResponse('moved successful', 200);
    }

    public function publishOrUnPublishProduct(ProductPublishUnPublishFormRequest $request)
    {
        $productDetails = $request->input();
        $this->productInterface->publishOrUnPublishProduct($productDetails);
        if ($productDetails['is_published'] == 0) {
            return $this->successResponse('product unpublished', 200);
        } elseif ($productDetails['is_published'] == 1) {
            return $this->successResponse('product published', 200);
        }
    }



    /*/*** variants  */


    // public function createProductVariant(ProductVariantFormRequest $request)
    // {
    //     $variant = $request->validated();
    //     $this->productInterface->createProductVariant($variant);
    //     return $this->successResponse('created success', 201);
    // }

    public function DeleteVariant($variant_id)
    {
        $variant = $this->productInterface->deleteVariantsFromProduct($variant_id);
        if ($variant) {
            return $this->successResponse('success', 200);
        } else {
            return $this->errorResponse('not authorized', 401);
        }
    }
    public function deleteVariantValue($value_id)
    {
        $variant = $this->productInterface->deleteVariantValue($value_id);
        if ($variant) {
            return $this->successResponse('success', 200);
        } else {
            return $this->errorResponse('not authorized', 401);
        }
    }
    /**
     * Undocumented function
     *
     * @param Request $variant_id
     * @return void
     */
    public function getVariantsValues(Request $variant_id)
    {
        return $this->dataResponse(['values' => VariantValueResource::collection($this->productInterface->getVariantsValues($variant_id->variant_id))], 'success', 200);
    }



    /**
     * Undocumented function
     *
     * @param Request $variant_id
     * @return void
     */
    public function getProductVariants(Request $request, $productID)
    {
        $variants = $this->productInterface->getProductVariants($productID);
        return $this->dataResponse(['variants' => VariantResource::collection($variants)], 'success', 200);
    }

    public function getProductStockBranches($product_id)
    {
        $branches = $this->productInterface->productStockBranches($product_id);
        return $this->dataResponse(['stock_branches' => ProductBranchStockResource::collection($branches)], 'success', 200);
    }
}
