<?php

namespace App\Classes;

use App\Models\Category;
use App\Models\ProviderShopDetails;

class ModelsMap
{


    private static $search = [
        'categories' => Category::class,
        'shops' => ProviderShopDetails::class,
    ];



    public static function search()
    {
        return self::$search;
    }
}
