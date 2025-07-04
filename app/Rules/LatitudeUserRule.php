<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LatitudeUserRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $location=auth('user')->user()->userLocation;

        if($location || isset(request()->latitude)){
          return  true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The latitude field is required when user not have location area.';
    }
}
