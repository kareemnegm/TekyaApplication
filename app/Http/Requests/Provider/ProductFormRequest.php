<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends BaseFormRequest
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
            'name'=>'required',
            'description'=>'nullable',
            'price'=>'required',
            'start_date' => 'nullable|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date',
            'stock_quantity'=>'required',
            'total_weight'=>'nullable',
            'is_published'=>'required|in:1,0',
            'to_donation'=>'required|in:1,0',
            'variant_id'=>'nullable',
            'collection_id'=>'required|exists:collections,id',
            'category_id'=>'required|exists:categories,id',
            'tags'=>'nullable|array',
            'product_images'=>'nullable'

         ];
    }
}
