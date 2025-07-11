<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\LatitudeUserRule;
use App\Rules\LogitudeUserRule;
use Illuminate\Foundation\Http\FormRequest;

class ShopIdFormRequest extends BaseFormRequest
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
            'shop_id' => 'required|exists:provider_shop_details,id',
            'area_id'=>'nullable|exists:areas,id',

            // 'latitude'=>[new LatitudeUserRule()],
            // 'longitude'=>[new LogitudeUserRule()],


        ];
    }
}
