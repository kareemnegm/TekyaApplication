<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Interfaces\DeliveryCoverageInterface;
use App\Models\deliveryCoverage;
use Illuminate\Support\Facades\Auth;

class DeliveryCoverageRepository extends Controller implements DeliveryCoverageInterface
{
    /**
     * Undocumented function
     *
     * @param [type] $details
     * @return void
     */
    public function storeCoverage($details)
    {
        $coverageArea = deliveryCoverage::create($details);
        return $coverageArea;
    }
    /**
     * Undocumented function
     *
     * @param [type] $shop_id
     * @return void
     */
    public function getAllDeliveryCoverage($shop_id)
    {
        $coverageAreas = deliveryCoverage::where('shop_id', $shop_id)->get();
        return $coverageAreas;
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function getDeliveryCoverage($id)
    {
        $coverageAreas = deliveryCoverage::find($id);
        return $coverageAreas;
    }


    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDeliveryCoverage($id)
    {
        $shop_id = Auth::user()->providerShopDetails->id;
        $coverageAreasExists = deliveryCoverage::where('id', $id)->where('shop_id', $shop_id)->exists();

        if ($coverageAreasExists) {
            $coverageAreas = deliveryCoverage::findOrFail($id);
            $coverageAreas->delete();
        }else{
            return $this->errorResponseWithMessage('the delivery coverage not exists ,or not own this delivery coverage', 401);
 
        }
    }


    /**
     * Undocumented function
     *
     * @param [type] $id
     * @param [type] $data
     * @return void
     */
    public function updateDeliveryCoverage($id, $data)
    {
        $delivery = deliveryCoverage::findOrFail($id);
        $delivery->update($data);
        return $delivery;
    }
}
