<?php

namespace App\Rules\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class UnusedPassword.
 */
class MatchOldPassword implements Rule
{
    
    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('auth.wrong_old_password');
    }
}
