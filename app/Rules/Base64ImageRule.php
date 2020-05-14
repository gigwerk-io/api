<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Base64ImageRule implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!Str::startsWith($value, 'data:image/jpeg;base64') && !Str::startsWith($value, 'data:image/png;base64')){
            return false;
        }
        return true;
    }

    /**
     * @return array|string
     */
    public function message()
    {
        return 'The :attribute must be a base64 encoded image.';
    }
}
