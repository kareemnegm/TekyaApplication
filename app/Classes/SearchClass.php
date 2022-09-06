<?php

namespace App\Classes;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchResource;


class SearchClass extends Controller
{

    /**
     * Search function
     *
     * @param Request $request
     * @return void
     */
    public function search($request)
    {
        $keyword = $request->keyword;
        $limit = $request->limit;
        $models = ModelsMap::search();

        foreach ($models as $slug => $model) {
            $result = $model::query();

            if (isset($keyword) && !empty($keyword) && $model == 'App\Models\ProviderShopDetails') {
                $result = $result->where('shop_name', 'LIKE', '%' . $keyword . '%')->select(['id', 'shop_name']);
            }else{
                $result = $result->where('name', 'LIKE', '%' . $keyword . '%')->select(['id', 'name']);

            }



            if (isset($limit)) {
                $total_result = $result->get();
                $result = $result->paginate($limit);
            } else {
                $total_result = $result->get();
                $result = $result->paginate(6);
            }

            if ($result->isNotEmpty()) {

                foreach ($result as $obj) {
                    // dd($obj,$model);
                    $model_result[$slug][] = new  SearchResource($obj, $model);
                }
            }
            //Total Numbers Of Results
            if (!empty($total_result)) {
                $total = 0;
                foreach ($total_result as $obj) {
                    $total += 1;
                }
                $model_result['total_' . $slug] = $total;
            } else {
                $model_result['total_' . $slug] = 0;
            }
        }
        return $model_result;
    }
}
