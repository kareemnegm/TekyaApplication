<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserAddressFormRequest extends BaseFormRequest
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
            'address' => 'required',
            'street' => 'required',
            'address_details' => 'required',
            'government_id' => 'exists:governments,id',
            'area_id' => 'exists:areas,id,government_id,:government_id',
            'latitude' => 'required_without:area_id,government_id',
            'longitude' => 'required_without:area_id,government_id',
        ];
    }
}
