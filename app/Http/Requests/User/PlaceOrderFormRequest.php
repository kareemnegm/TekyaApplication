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
            'shops.*.delivery_option_id'=>'required',
            'shops.*.shipping_fees'=>'required',

            'shops.*.shipping_fees'=>'required',



            'shops.*.branch_id'=>['required_without:shops.*.address_id'],
        //     // 'exists:provider_shop_branches,id'],

            'shops.*.address_id'=>['required_without:shops.*.branch_id'],

            
            // 'shops.*.products'=>'required|array|min:1',
            // 'shops.*.products.*.id'=>'required',
            // 'shops.*.products.*.quantity'=>'required',
            'grand_total_price'=>'required',
            'payment_id'=>'required'
        ];
    }
}
