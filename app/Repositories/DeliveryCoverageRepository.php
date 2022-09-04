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

    public function getAllDeliveryCoverage($shop_id)
    {
        $coverageAreas = deliveryCoverage::where('shop_id', $shop_id)->get();
        return $coverageAreas;
    }


    public function getDeliveryCoverage($id){
        $coverageAreas = deliveryCoverage::find($id);
               return $coverageAreas;
    }
}
