<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function dataResponse($data , $message = null, $code = null){

        $success = [
            'code' => $code ? $code : 200,
            'message' => $message ? $message : 'success',
        ];

        $success = array_merge($success, $data);

        return response()->json($success, 200);
    }

    public function successResponse($message = null, $code = null){
        $success = [
            'code' => $code ? $code : 200,
            'message' => $message ? $message : 'success'
        ];

        return response()->json($success, 200);
    }

    public function errorResponse($message , $code){
        $error = [
            'code' => $code,
            'message' => $message
        ];

        return response()->json($error, $code);
    }

    public function errorResponseWithstatus($message , $code){
        $error = [
            'code' => $code,
            'message' => $message
        ];

        return response()->json($error, $code);
    }
}
