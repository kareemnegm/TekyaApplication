<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopDetailsFormRequest extends BaseFormRequest
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
            'shop_name'=>'required|unique:provider_shop_details,shop_name,'.auth('provider')->user()->providerShopDetails->id,
            'email'=>'sometimes|required|unique:provider_shop_details,email,'.auth('provider')->user()->providerShopDetails->id
        ];
    }
}
