<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class ShopBranchFormRequest extends BaseFormRequest
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
            'shop_id'=>'required|exists:provider_shop_details,id',
            "name"=>"required",
            "phone"=>"required|numeric",
            "is_head"=>'required',
            "working_hours_day"=>"required",
            "working_hours_day.*.startTimeStandard"=>"in:AM,PM",
            "address"=>"required",
            "street"=>"required",
            "area_id"=>"required|exists:areas,id",
            "government_id"=>"required|exists:governments,id",
            "nearest_landmark"=>"required",
            "payment_option_id.*"=>'required|exists:payment_options,id'

        ];
    }
}
