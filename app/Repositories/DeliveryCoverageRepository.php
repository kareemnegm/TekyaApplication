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


    public function getDeliveryCoverage($id)
    {
        $coverageAreas = deliveryCoverage::find($id);
        return $coverageAreas;
    }


    public function deleteDeliveryCoverage($id)
    {
        $coverageAreas = deliveryCoverage::find($id);
        $coverageAreas->delete();
    }


    public function updateDeliveryCoverage($id, $data)
    {
        $delivery = deliveryCoverage::findOrFail($id);
        $delivery->update($data);
        return $delivery;
    }
}
