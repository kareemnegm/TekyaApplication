<?php

namespace App\Interfaces\User;

interface ProductInterface {

    /**
     * Undocumented function
     *
     * @return void
     */
    public function mostPopularProduct();

    /**
     * Undocumented function
     *
     * @return void
     */
    public function productJustForYou();

        /**
     * Undocumented function
     *
     * @return void
     */
    public function relatedProducts($productId);

        /**
     * Undocumented function
     *
     * @return void
     */
    public function similarProducts($productId);

}
