<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends BaseFormRequest
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
            // 'first_name'=>'required',
            // 'last_name'=>'required',
            // 'email'=>'email|unique:users,email',
            // 'password'=>'required|min:8',
            'mobile' => ['required', new PhoneNumber,'max:11',Rule::unique('users')->whereNull('deleted_at')],
            'country_code' => ['nullable','in:+20'],

            // 'gender'=>'required|in:male,female',
            // 'government_id'=>'required|exists:governments,id',
            // 'area_id'=>'required|exists:areas,id',
        ];
    }
}
