<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvderSignUpFormRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name'=>'required|unique:providers,user_name',
            'email'=>'required|unique:providers,email',
            'password'=>'required|min:8',
            'type'=>'required',
            'number'=>'required|unique:providers,number|numeric',
        ];
    }
}
