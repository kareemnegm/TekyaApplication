<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductPublishUnPublishFormRequest extends BaseFormRequest
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
        $shop_id=Auth::user()->providerShopDetails->id;
        return [
            'product_id' => 'required|exists:products,id,shop_id,'.$shop_id,
            'is_published' => 'required|in:0,1'
        ];

    }
       /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
        'product_id.exists'=>'The selected product id is invalid.',
        ];
    }
}
