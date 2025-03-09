<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserId implements Rule
{
    public function passes($attribute, $value)
    {
        // Custom validation logic (e.g., check if user ID exists)
        return User::where('user_id', $value)->exists();
    }

    public function message()
    {
        return 'The user ID does not exist.';
    }
}