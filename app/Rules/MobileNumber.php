<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;


class MobileNumber implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Remove any non-numeric characters from the value
        $numericValue = preg_replace('/[^0-9]/', '', $value);

        // Check if the numeric value is exactly 11 digits and starts with '01'
        return strlen($numericValue) === 11 && strpos($numericValue, '01') === 0;
    }

    public function message()
    {
        return 'The :attribute must be a valid 11-digit mobile number starting with "01".';
    }
}
