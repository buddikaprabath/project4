<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NationalId implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove any non-digit characters
        $value = preg_replace('/[^0-9]/', '', $value);

        // Check if the value matches the required pattern
        return preg_match('/^(?:\d{9}[v]|[0-9]{12})$/', $value);
    }

    public function message()
    {
        return 'The :attribute must be a 9-digit number followed by a letter, or a 12-digit number.';
    }
}