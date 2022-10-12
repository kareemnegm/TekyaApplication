<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\UnitPricePoructRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function rules(Request $request)
    {
        return [
            'shops.*'=>'required|array|min:1',

            'shops.*.id'=>'required',

            'shops.*.coupon_id'=>'nullable',
            
            'shops.*.delivery_option_id'=>'required|exists:delivery_options,id',

            'shops.*.shipping_fees'=>'required',

            'shops.*.branch_id'=>'sometimes|nullable|required_if:shops.*.delivery_option_id,2|exists:provider_shop_branches,id',

            'shops.*.address_id'=>'sometimes|nullable|required_if:shops.*.delivery_option_id,1|exists:user_addresses,id',

            'grand_total_price'=>'required',

            'payment_id'=>'required|exists:payment_options,id'
        ];
    }
}
