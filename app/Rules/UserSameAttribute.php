<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserSameAttribute implements Rule
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
        return $value !== Auth::user()->email;
//        \Illuminate\Validation\Rule::unique('users')->ignore(Auth::user()->id);

//        return \Illuminate\Validation\Rule::unique('users', 'email');

//        Rule::unique('users')->ignore($user->id, 'user_id')
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation :attribute error message email.';
    }
}
