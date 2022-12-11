<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\AreaShopRule;
use Illuminate\Foundation\Http\FormRequest;

class SingleShopResource extends BaseFormRequest
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


        if (auth('user')->check()) {
            return [
                'shop_id' => 'required|exists:provider_shop_details,id',

                // 'shop_id'=>[new AreaShopRule(request()->latitude,request()->longitude)],

            ];
        }

        return [
            'shop_id' => 'required|exists:provider_shop_details,id',
            'area_id'=>'required_without:latitude,longitude|exists:areas,id',
            'latitude' => ['required_without:area_id', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required_without:area_id', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ];
    

    }
}
