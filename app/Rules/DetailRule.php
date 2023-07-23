<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DetailRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach (explode(PHP_EOL, $value) as $row) {
            if (!preg_match('/^(⬛|🟨|🟩){5}$/', $row)) {
                $fail('format is invalid.');//return false;
            }
        }
    }
}
