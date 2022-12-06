<?php

namespace App\Http\Requests\System;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class OrderShopIdFormRequest extends BaseFormRequest
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
            'order_shop_id' => 'required|exists:order_shops,id',
            'status' => 'required|in:pending,process,picked,onway,arrived,ready,rejected'
        ];
    }
}
