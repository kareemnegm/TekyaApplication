<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $shop_id = Auth::user()->providerShopDetails->id;
        return [
            'shop_branch_id' => 'required|exists:provider_shop_branches,id,shop_id,' . $shop_id,
            'government_id' => 'required|exists:governments,id',
            'area_id' => 'exists:areas,id',
            'delivery_fees' => 'required',
            'delivery_estimated_time' => 'required',
            'delivery_date_time' => 'required',
        ];
    }
}
