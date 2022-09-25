<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderFormRequest extends BaseFormRequest
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
            'shops.*'=>'required|array|min:1',
            'shops.*.id'=>'required',
            'shops.*.total_price'=>'required',
            'shops.*.coupon_id'=>'nullable',
            'shops.*.delivery_option_id'=>'required',
            'shops.*.shipping_fees'=>'required',
            'shops.*.products'=>'required|array|min:1',
            'shops.*.products.*.id'=>'required',
            'shops.*.products.*.quantity'=>'required',

            'tekya_wallet'=>'nullable',
            'tekya_points'=>'nullable',
            'taxes'=>'nullable',

            
        ];
    }
}
