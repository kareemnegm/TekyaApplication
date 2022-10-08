<?php

namespace App\Http\Requests\Provider\Product;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductVariantFormRequest extends BaseFormRequest
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
            'product_id' => 'required|exists:products,id',
            'name' => 'required|unique:product_variants,name,product_id',
            'variant_values' => 'required',
            'variant_values.*.is_default' => 'distinct'
        ];
    }
}
