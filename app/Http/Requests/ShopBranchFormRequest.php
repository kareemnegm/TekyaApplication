<?php

namespace App\Http\Requests;

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
            "name"=>"required",
            "phone"=>"required|numeric",
            "is_head"=>'required',
            "working_hours_day"=>"required",
            "working_hours_day.*.startTimeStandard"=>"in:AM,PM",
            "street"=>"required",
            "area_id"=>"required_without:latitude,longitude|exists:areas,id",
            "government_id"=>"required_without:latitude,longitude|exists:governments,id",
            "nearest_landmark"=>"required",
            "address_details"=>"required",
            "latitude"=>"required_without:area_id,government_id|numeric",
            "longitude"=>"required_without:area_id,government_id|numeric",
            "payment_option_id.*"=>'required|exists:payment_options,id',
            'delivery' => 'in:1,0',
            'pick_up' => 'in:1,0',

        ];
    }
}
