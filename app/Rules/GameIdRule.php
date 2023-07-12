<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class GameIdRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/^(([1-6]|x)\/6)$/', $value)) {
            $fail('format is invalid.');
        }
    }

    public function passes( $value)  {
        //return preg_match('/^#+(\d{1,3})$/', $value);
    }
}
