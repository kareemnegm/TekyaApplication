<?php

namespace App\Http\Requests\User;

use App\Models\Cart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DeleteShopFromCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $cart_id = Auth::user()->cart->id;
        $cart  = Cart::findOrFail($cart_id);
        return [
            'shop_id' => [
            'required',
            
            Rule::exists('cart_products', 'shop_id') ->                    
              where('cart_id',$cart->id) ->where('shop_id',$request->shop_id)
            ],
        ];
    }
}
