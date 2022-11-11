<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class SaleFormRequest extends BaseFormRequest
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
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'discount_cap' => 'required',
            'discount' => 'required|numeric',
            'price_range_start' => 'required|numeric',
            'price_range_end' => 'required|numeric',
            'category_id.*' => 'required|exists:categories,id',
            
        ];
    }
}
