<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShopDetailsFormRequest extends BaseFormRequest
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
            'shop_name' => 'unique:provider_shop_details,shop_name',
            'whatsapp_number' => 'numeric|min:10',
            'email' => 'email',
            'category_id.*' => 'required|exists:categories,id',
            'delivery' => 'required|in:1,0',
            'pick_up' => 'required|in:1,0',
        ];
    }
}
