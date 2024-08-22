<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidSriLankanVehicleNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Define regex patterns for the different formats with hyphens
        $patterns = [
            '/^[A-Z]{2}-?\d{1,4}$/',         // Old Format: XX-1234 or XX1234
            '/^[A-Z]{3}-?\d{1,4}$/',         // Intermediate Format: XXX-1234 or XXX1234
            '/^[A-Z]{2}-[A-Z]{3}-\d{4}$/', // New Format: XX-XXX-1234
            '/^[A-Z]{2}-GA-\d{3}$/',       // Government Vehicles: XX-GA-123
            '/^DPL-\d{3}$/'                // Diplomatic Vehicles: DPL-123
        ];

        // Remove hyphens from the value for validation purposes
        $valueWithoutHyphens = str_replace('-', '', $value);

        // Check if value matches any of the patterns
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $valueWithoutHyphens)) {
                return true;
            }
        }

        return false;
    }

    public function message()
    {
        return 'The :attribute is not a valid Sri Lankan vehicle number.';
    }
}