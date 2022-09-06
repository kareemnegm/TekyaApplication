<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function dataResponse($data , $message = null, $code = null){

        $success = [
            'status' => $code ? $code : 200,
            'message' => $message ? $message : 'success',

        ];

        $success = array_merge($success, ['data'=>['result'=>$data]]);

        return response()->json($success, 200);
    }

    public function successResponse($message = null, $code = null){
        $success = [
            'status' => $code ? $code : 200,
            'message' => $message ? $message : 'success',
            'data'=>null
        ];

        return response()->json($success, 200);
    }

    public function errorResponse($message , $code){
        $error = [
            'status' => $code,
            'message' => $message
        ];

        return response()->json($error, $code);
    }

    public function errorResponseWithstatus($message , $code){
        $error = [
            'status' => $code,
            'message' => $message
        ];

        return response()->json($error, $code);
    }


    public function errorResponseWithMessage($message , $code){

      $res=[
            'status' => $code ? $code : 422, 
            'message'=>'Validation error', 
            'error' => [$message], 
            'data'=>null
        ];
        
        throw new HttpResponseException(response()->json($res
        , 422));
    }
    /**
  * Gera a paginação dos itens de um array ou collection.
  *
  * @param array|Collection      $items
  * @param int   $perPage
  * @param int  $page
  * @param array $options
  *
  * @return LengthAwarePaginator
  */
public function paginateCollection($items, $perPage ,$key , $options = [],$page = null)
{
    $key=$key?$key:'data';
    $perPage=$perPage ? $perPage:10;

	$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

	$items = $items instanceof Collection ? $items : Collection::make($items);

    $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    return [
        "status"=> 200,
        "message"=>"success",
        "data"=>[
            "result"=>[
        'current_page' => $lap->currentPage(),
         $key => $lap ->values(),
        'first_page_url' => $lap ->url(1),
        'from' => $lap->firstItem(),
        'last_page' => $lap->lastPage(),
        'last_page_url' => $lap->url($lap->lastPage()),
        'next_page_url' => $lap->nextPageUrl(),
        'per_page' => $lap->perPage(),
        'prev_page_url' => $lap->previousPageUrl(),
        'to' => $lap->lastItem(),
        'total' => $lap->total(),
        ]
        ]
    ];
}
}
