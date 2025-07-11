<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderReviewFormRequest extends BaseFormRequest
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
        $user = Auth::user();
        return [

            'order_review'=>'required|array|min:1',
            'order_review.*.shop_id'=>['required',Rule::exists('cart_product', 'provider_shop_details_id')->where('cart_id',$user->cart->id)  ],

            'order_review.*.delivery_option_id'=>'required|exists:delivery_options,id',
            'payment_id'=>'required|exists:payment_options,id' ,
            
            'order_review.*.branch_id'=>'sometimes|nullable|required_if:shops.*.delivery_option_id,2|exists:provider_shop_branches,id',
            'order_review.*.address_id'=>'sometimes|nullable|required_if:shops.*.delivery_option_id,1|exists:user_addresses,id',


        ];
    }
}
