<?php

namespace App\Interfaces\User;

interface ShopInrerface {

    /**
     * Undocumented function
     *
     * @return void
     */
    public function nearestShops($request);

    /**
     * Undocumented function
     *
     * @return void
     */
    public function newShops($request);

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function shopsProducts($request);

    
}
