<?php

namespace App\Observers;

use App\Models\Bundel;
use App\Models\Product;
use App\Models\Sale;

class SaleObserver
{
    /**
     * Handle the Sale "creating" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function creating(Sale $sale)
    {

        $products = Product::where('shop_id', $sale->shop_id)->where('category_id', $sale->category_id)->get();
        if (isset($products))
            foreach ($products as $product) {
                if ($product->price >= $sale->price_range_start && $product->price <= $sale->price_range_end) {
                    $offer = ($product->price * $sale->discount) / 100;
                    $productPriceCheckInCap = $product->price - $offer;
                    if ($productPriceCheckInCap <= $sale->discount_cap) {
                        $product->offer_price = $productPriceCheckInCap;
                        $product->save();
                    }
                }
            }
        $bundles = Bundel::where('shop_id', $sale->shop_id)->where('category_id', $sale->category_id)->get();

        if (isset($bundles)) {
            foreach ($bundles as $bundle) {
                if ($bundle->price >= $sale->price_range_start && $bundle->price <= $sale->price_range_end) {
                    $offer = ($bundle->price * $sale->discount) / 100;
                    $bundlePriceCheckInCap = $bundle->price - $offer;
                    if ($bundlePriceCheckInCap <= $sale->discount_cap) {
                        $bundle->offer_price = $bundlePriceCheckInCap;
                        $bundle->save();
                    }
                }
            }
        }
    }
    /**
     * Handle the Sale "created" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function created(Sale $sale)
    {
        //
    }


    /**
     * Handle the Sale "updated" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function updated(Sale $sale)
    {
        $products = Product::where('shop_id', $sale->shop_id)->where('category_id', $sale->category_id)->get();
        foreach ($products as $product) {
            if ($product->price >= $sale->price_range_start && $product->price <= $sale->price_range_end) {
                $offer = ($product->price * $sale->discount) / 100;
                $productPriceCheckInCap = $product->price - $offer;
                if ($productPriceCheckInCap <= $sale->discount_cap) {
                    $product->offer_price = $productPriceCheckInCap;
                    $product->save();
                }
            }
        }
        $bundles = Bundel::where('shop_id', $sale->shop_id)->where('category_id', $sale->category_id)->get();

        if (isset($bundles)) {
            foreach ($bundles as $bundle) {
                if ($bundle->price >= $sale->price_range_start && $bundle->price <= $sale->price_range_end) {
                    $offer = ($bundle->price * $sale->discount) / 100;
                    $bundlePriceCheckInCap = $bundle->price - $offer;
                    if ($bundlePriceCheckInCap <= $sale->discount_cap) {
                        $bundle->offer_price = $bundlePriceCheckInCap;
                        $bundle->save();
                    }
                }
            }
        }
    }



    /**
     * Handle the Sale "deleted" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function deleted(Sale $sale)
    {
        $products = Product::where('shop_id', $sale->shop_id)->where('category_id', $sale->category_id)->get();
        foreach ($products as $product) {
            $product->offer_price = 0;
            $product->save();
        }

        $bundles = Bundel::where('shop_id', $sale->shop_id)->where('category_id', $sale->category_id)->get();

        if (isset($bundles)) {
            foreach ($bundles as $bundle) {

                $bundle->offer_price = 0;
                $bundle->save();
            }
        }
    }

    /**
     * Handle the Sale "restored" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function restored(Sale $sale)
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     *
     * @param  \App\Models\Sale  $sale
     * @return void
     */
    public function forceDeleted(Sale $sale)
    {
        //
    }
}
