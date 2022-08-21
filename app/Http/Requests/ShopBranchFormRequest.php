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
            "address"=>"required",
            "street"=>"required",
            "area"=>"required",
            "nearest_landmark"=>"required"

        ];
    }
}
