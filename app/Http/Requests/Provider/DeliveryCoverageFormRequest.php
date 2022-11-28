<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DeliveryCoverageFormRequest extends BaseFormRequest
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
            'government_id' => 'required|exists:governments,id',
            'area_id' => [
                'required',
                Rule::exists('areas', 'id')->where('government_id',request()->government_id),
            ],
            'delivery_fees' => 'required',
            'delivery_estimated_time' => 'required',
            'notes' => 'nullable|string',

        ];
    }
}
