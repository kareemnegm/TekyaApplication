<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderFormRequest extends BaseFormRequest
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
            'delivery_option'=>'required|in:pickup,delivery',
            'payment_id'=>'required|exists:payment_options,id',
            'address_id'=>'required|exists:user_addresses,id',
            'order_details'=>'required',
            'invoices_total'=>'required',
        ];
    }
}
