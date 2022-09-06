<?php

namespace App\Http\Requests\Provider\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'sortBy'=>'in:alphabetical,price,date_of_creating,order'
        ];
    }
    public function messages()
    {
        return [
            'sortBy.in'=>' :attribute is used in alphabetical , price , date_of_creating , order'
        ];
    }
}
