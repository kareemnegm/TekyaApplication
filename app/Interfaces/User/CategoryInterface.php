<?php

namespace App\Interfaces\User;

interface CategoryInterface {


    /**
     * Undocumented function
     *
     * @return void
     */
    public function getCategories($req);

     /**
     * Undocumented function
     *
     * @return void
     */
    public function getSubCategories($req);
     /**
     * Undocumented function
     *
     * @return void
     */
    public function categoryShops($req);

    /**
     * Undocumented function
     *
     * @return void
     */
    public function categoryProducts($req);
}
