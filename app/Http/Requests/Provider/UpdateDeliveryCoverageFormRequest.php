<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDeliveryCoverageFormRequest extends BaseFormRequest
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
        $shop_id = Auth::user()->providerShopDetails->id;
        return [
            'delivery_coverage_id'=>'required|exists:delivery_coverages,id,shop_id,' . $shop_id,
            'average_delivery_time'=>'nullable|numeric',
            'delivery_fees'=>'nullable|numeric',
        ];
    }
}
