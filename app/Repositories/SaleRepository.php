<?php

namespace App\Repositories;

use App\Interfaces\SaleInterface;
use App\Models\Sale;

class SaleRepository implements SaleInterface
{
    public function createSale($details)
    {
        $categories = $details['category_id'];
        foreach($categories as $category){
        $details['category_id']=$category;
        Sale::create($details);
        }
        return;
    }
}
