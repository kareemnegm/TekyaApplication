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

                $result= $this->paginateCollection($result->get(),$request->limit,'items');
                $total_result = $result['data']['result']['items']->count();

                $result=$result['data']['result']['items'];
            } else {
                $result= $this->paginateCollection($result->get(),$request->limit,'items');
                $total_result = $result['data']['result']['items']->count();
                $result=$result['data']['result']['items'];
            }

            if ($result->isNotEmpty()) {

                foreach ($result as $obj) {
                    $model_result[$slug][] = new  SearchResource($obj, $model);
                }
            }
            
                $model_result['total_' . $slug] = $total_result;
           
        }
        return $model_result;
    }
}
