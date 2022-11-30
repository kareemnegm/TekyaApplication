<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderBranchFormRequest extends BaseFormRequest
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
         'order_type' =>'nullable|in:recent,pickup,delivery,canceled'
        ];
    }


        /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'order_type.in'=>' :attribute is used in recent,pickup,delivery,canceled',
        ];
    }


}
