<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
      /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function failedValidation(Validator $validator)
    {
        $errors=[];
        foreach($validator->errors()->toArray() as $key=>$value){
            $errors[$key]=$value[0];
        }

        $res=[
            'status'=>422, //code error
            'message'=>'Validation error', //Massage Return in Response Data field
            'error' => $validator->errors()->all(), //Validator Errors
            'data'=>null
        ];
        //   return response()->json($res,200,JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
          throw new HttpResponseException(response()->json($res
          , 422));
    }


}
