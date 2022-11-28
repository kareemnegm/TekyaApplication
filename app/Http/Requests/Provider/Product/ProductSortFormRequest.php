<?php

namespace App\Http\Requests\Provider\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductSortFormRequest extends BaseFormRequest
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
    public function rules(Request $request)
    {
      
        return [
            'filter'=>'in:name,price,created_at,order',
            'sortBy'=>'in:desc,asc',
            'is_published'=>'in:true,false',
            'in_collection'=>'in:true,false',
            'page'=>'integer',
            'limit'=>'integer',
        ];
    }
    public function messages()
    {
        return [
            'filter.in'=>' :attribute is used in name,price,created_at,order',
            'sortBy.in'=>' :attribute is used in dsec,asc'

        ];
    }
}
