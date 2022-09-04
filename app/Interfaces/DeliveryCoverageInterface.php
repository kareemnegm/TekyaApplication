<?php

namespace App\Interfaces;

interface DeliveryCoverageInterface
{
    public function deliveryCoverage($details);

    public function getAllDeliveryCoverage($shop_id);
    public function getDeliveryCoverage($id);
}
