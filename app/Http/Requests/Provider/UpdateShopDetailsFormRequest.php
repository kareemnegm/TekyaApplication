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
            'shop_name' => 'required',
            'whatsapp_number' => 'numeric|min:10',
            'email' => 'email',
            'category_id' => 'required|exists:categories,id',
            'delivery' => 'required_without:pick_up|in:1,0|different:pick_up',
            'pick_up' => 'required_without:delivery|in:1,0|different:delivery',
        ];

    }

    public function messages(): array
    {
        return [
            'pick_up.different' => ':attribute must choose :attribute or :other.',
            'delivery.different'
        ];
    }



}
