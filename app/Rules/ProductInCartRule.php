<?php

namespace App\Rules;

use App\Models\CartProduct;
use Illuminate\Contracts\Validation\Rule;

class ProductInCartRule implements Rule
{
    public $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request=$request;
    }


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $shopCount=CartProduct::where('cart_id',$this->request->cart_id)
        ->where('provider_shop_details_id',$this->request->shop_id)->count() >= 6;

        if($shopCount){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The max Product be 2 in shop in your cart.';
    }
}
