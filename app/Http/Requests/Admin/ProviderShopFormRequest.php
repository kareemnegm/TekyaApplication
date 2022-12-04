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
            'provider_id' => 'required|exists:providers,id',
            'shop_name' => 'required|unique:provider_shop_details,shop_name,' . $this->id,
            'whatsapp_number' => 'required|numeric|min:10',
            'email' => 'required|email',
            'category_id' => 'required',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'facebook_link' => 'nullable',
            'instagram_link' => 'nullable',
            'web_site' => 'nullable',
            'shop_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20000',
            'category_id.*' => 'nullable|exists:categories,id',
            "street" => "required",
            "area_id" => "required_without:latitude,longitude|exists:areas,id",
            "government_id" => "required_without:latitude,longitude|exists:governments,id",
            "nearest_landmark" => "required",
            "address_details" => "required",
            "latitude" => "required_without:area_id,government_id|numeric",
            "longitude" => "required_without:area_id,government_id|numeric",
            "payment_option_id.*" => 'required|exists:payment_options,id',
            'delivery' => 'in:1,0',
            'pick_up' => 'in:1,0',
           
        ];
    }
}
