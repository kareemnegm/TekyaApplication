<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProviderShopFormRequest extends BaseFormRequest
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
            'user_name'=>'required|unique:providers,user_name',
            'email'=>'required|unique:providers,email',
            'mobile'=>'required|unique:providers,mobile|numeric',
            'shop_name'=>'required|unique:provider_shop_details,shop_name',
            'whatsapp_number' => 'numeric|min:10',
            'email' => 'email',
            'category_id.*' => 'required|exists:categories,id',
        ];
    }
}
