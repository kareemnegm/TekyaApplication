<?php

namespace App\Http\Requests\Provider;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderBranchFormRequest extends BaseFormRequest
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
            
            'branch_id' => [
                'required',
                Rule::exists('provider_shop_branches', 'id')->where('shop_id',auth('provider')->user()->providerShopDetails->id),
            ],

            // 'order_type' =>'required|in:pickup,delivery'
        ];
    }


    
   
}
