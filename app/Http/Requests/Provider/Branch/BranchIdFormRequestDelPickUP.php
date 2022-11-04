<?php

namespace App\Http\Requests\Provider\Branch;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class BranchIdFormRequestDelPickUP extends BaseFormRequest
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
        $shop_id=auth('provider')->user()->providerShopDetails->id;
        return [
          "branch_id"=>'required|exists:provider_shop_branches,id,shop_id,'.$shop_id,
          'pick_up'=>'required_without:delivery',
          'delivery'=>'required_without:pick_up',
        ];
    }
}
