<?php

namespace App\Repositories;

use App\Interfaces\SaleInterface;
use App\Models\Sale;

class SaleRepository implements SaleInterface
{
    public function createSale($details)
    {
        return Sale::create($details);
    }
}
