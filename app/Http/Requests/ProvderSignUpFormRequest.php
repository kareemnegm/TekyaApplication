<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

            'user_name'=>   ['required', Rule::unique('providers')->whereNull('deleted_at')],
            'email'=>   ['required', Rule::unique('providers')->whereNull('deleted_at')],
            
            'password'=>'required|min:8',
            'type'=>'required',
            'mobile'=>   ['required', Rule::unique('providers')->whereNull('deleted_at')],
        ];
    }
}
