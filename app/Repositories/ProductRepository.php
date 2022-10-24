<?php

namespace App\Repositories;

use App\Interfaces\CollectionInterface;
use App\Interfaces\ProductInterface;
use App\Models\BranchProductStock;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantValue;
use GuzzleHttp\Psr7\Request;

class ProductRepository implements ProductInterface
{

    /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAllShopProduct($request)
    {

        $q = Product::query();

        $q->where('shop_id', auth('provider')->user()->providerShopDetails->id);

        if ($request->is_publish) {
            $is_publish = $request->is_publish == 'true' ? 1 : 0;
            $q->where('is_publish', $is_publish);
        }

        if (isset($request->sortBy) && isset($request->filter)) {
            $collections = $q->orderBy($request->filter, $request->sortBy)->get();
        } else {
            $collections = $q->orderBy('order', 'ASC')->get();
        }

        return $collections;
    }
    /**
     * Get All Shop Collection function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getAllShopCollectionProduct($request, $collectionId)
    {

        $q = Product::query();

        $q->where('collection_id', $collectionId);

        if ($request->is_publish) {
            $is_publish = $request->is_publish == 'true' ? 1 : 0;
            $q->where('is_publish', $is_publish);
        }

        if (isset($request->sortBy) && isset($request->filter)) {

            $collections = $q->orderBy($request->filter, $request->sortBy)->get();
        } else {
            $collections = $q->orderBy('order', 'ASC')->get();
        }

        return $collections;
    }

    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function getProductById($collectionID)
    {

        return Product::findOrFail($collectionID);
    }
    /**
     * Undocumented function
     *
     * @param [type] $projectId
     * @return void
     */
    public function deleteShopProduct($projectIDs)
    {
        Product::destroy($projectIDs);
    }
    /**
     * Create Product  function
     *
     * @param [type] $projectId
     * @return void
     */
    public function createShopProduct(array $productDetails)
    {
        $productDetails['shop_id'] = auth('provider')->user()->providerShopDetails->id;

        $product = Product::create($productDetails);


        if (isset($productDetails['tags'])) {
            $product->attachTags($productDetails['tags']);
        }

        if (!empty($productDetails['product_images'])) {
            $product->saveFiles($productDetails['product_images'], 'product_images');
        }
        if (!empty($productDetails['branches_stock'])) {
            return $this->branchProductStock($productDetails['branches_stock'], $product->id);
        }

        if (!empty($productDetails['variants'])) {
            return $this->productVarints($productDetails['variants'], $product);
        } else {
            return $product;
        }


    }



    private function branchProductStock(array $branchStocks, $product_id)
    {
        foreach ($branchStocks as $branchStock) {
             BranchProductStock::updateOrCreate(
                ['product_id' => $product_id, "branch_id" => $branchStock->branch_id, 'stock_qty' => $branchStock->stock_qty],
                ['product_id' => $product_id, "branch_id" => $branchStock->branch_id, 'stock_qty' => $branchStock->stock_qty]
            );
        }
        return;
    }


    /**
     * Undocumented function
     *
     * @param [type] $varients
     * @return array
     */
    public function productsSearch($request)
    {

        $prdoucts = Product::orderBy('order', 'ASC')->where('name', 'like', '%' . $request . '%')->get();
        return $prdoucts;

    }

    /**
     * Undocumented function
     *
     * @param [type] $varients
     * @return array
     */
    private function productVarints(array $varients, $product)
    {
        foreach ($varients as $varient => $variantValue) {
            $productVariant = ProductVariant::updateOrCreate(
                ['product_id' => $product->id, "name" => $varient],
                ["name" => $varient]
            );

            foreach ($variantValue as $values) {
                $productVariant->value()->create($values);
            }
        }
        return $product;
    }



    /**
     * Product Update function
     *
     * @param [type] $projectId
     * @return void
     */
    public function updateShopProduct($collectionID, array $newDetails)
    {

        $product = Product::findOrFail($collectionID);

        $newDetails['shop_id'] = auth('provider')->user()->providerShopDetails->id;

        $product->update($newDetails);

        $product->syncTags($newDetails['tags']);

        if (!empty($newDetails['product_images'])) {
            foreach ($newDetails['product_images'] as $productImage) {
                $product->saveFiles($productImage, 'product_images');
            }
        }


        return $product;
    }


    public function remove_product_from_collection($products)
    {
        $products = Product::whereIn('id', $products)->update(['collection_id' => null]);
    }



    public function move_product_from_collection($products, $collection_id)
    {
        $products = Product::whereIn('id', $products)->update(['collection_id' => $collection_id]);
        return $products;
    }

    public function publishOrUnPublishProduct($productDetails)
    {
        $products = Product::where('id', $productDetails['product_id'])->update(['is_published' => $productDetails['is_published']]);
    }



    /***product variants  */

    public function createProductVariant($variant)
    {
        $product = Product::findOrFail($variant['product_id']);
        $productVariant = $product->variant()->create($variant);
        foreach ($variant['variant_values'] as $values) {
            $productVariant->value()->create($values);
        }
        return;
    }

    public function deleteVariantsFromProduct($variant_id)
    {
        $product_variants = ProductVariant::findOrFail($variant_id);
        $provider = Auth('provider')->user()->providerShopDetails->id;
        $product_id = $product_variants->product->shop_id;
        if ($provider == $product_id) {
            $product_variants->delete();
            return true;
        }
        return false;
    }


    public function deleteVariantValue($value_id)
    {
        $variant_value = VariantValue::findOrFail($value_id);
        $provider = Auth('provider')->user()->providerShopDetails->id;
        $product_id = $variant_value->productVariant->product->shop_id;
        if ($provider == $product_id) {
            $variant_value->delete();
            return true;
        }
        return false;
    }

    public function getVariantsValues($variant_id)
    {
        $product_variants = ProductVariant::findOrFail($variant_id);
        return $product_variants->value;
    }

    /**
     * Undocumented function
     *
     * @param [type] $variant_id
     * @return void
     */
    public function getProductVariants($productId)
    {
        $product = Product::findOrFail($productId);

        return $product->variant;
    }
}
