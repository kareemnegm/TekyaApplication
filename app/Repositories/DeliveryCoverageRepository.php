<?php

namespace App\Repositories;

use App\Interfaces\DeliveryCoverageInterface;
use App\Models\deliveryCoverage;

class DeliveryCoverageRepository implements DeliveryCoverageInterface
{
    public function deliveryCoverage($details)
    {
        $coverageArea = deliveryCoverage::create($details);
        return $coverageArea;
    }
}
