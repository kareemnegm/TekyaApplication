<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminDeliveryCovrageRequest extends BaseFormRequest
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
     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'government_id' => 'required|exists:governments,id',
            'area_id' => [
                'required',
                Rule::exists('areas', 'id')->where('government_id',request()->government_id),
            ],
            'delivery_fees' => 'required',
            'shop_id' => 'required|exists:provider_shop_details,id',
            'delivery_estimated_time' => 'required',
            'notes' => 'nullable|string',

        ];
    }
}
