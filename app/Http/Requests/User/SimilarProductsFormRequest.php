<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class SimilarProductsFormRequest extends BaseFormRequest
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
            'product_id'=>'required|exists:products,id',
        ];
    }
}
