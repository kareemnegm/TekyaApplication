<?php

namespace App\Interfaces;

interface SaleInterface
{
    public function createSale($details);
    public function updateSale($details);
    public function shopSales($shop_id);
    public function deleteSales($sale_id);
    public function singleSale($sale_id);
}
