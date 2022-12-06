<?php

namespace App\Http\Requests\System;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminFinanceOrderRequest extends BaseFormRequest
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
            'shop_id' => 'nullable|exists:provider_shop_details,id',
            'order_type' => 'nullable|in:recent,pickup,delivery,rejected,canceled',
            'sort' => 'nullable|in:asc,desc',

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
            'order_type.in'=>' :attribute is used in recent,pickup,delivery,rejected,canceled',
            'sort.in'=>' :attribute is used in asc,desc',

        ];
    }
}
