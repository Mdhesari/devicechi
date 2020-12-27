<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileIran implements Rule
{

    public static $regex = '/(9|0)?9\d{9}/';

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
        return preg_match(static::$regex, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.mobile');
    }
}
