<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ScoreRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(([1-6]|x)\/6)$/', $value)) {
            $fail('format is invalid.');
        }
    }

    public function passes($attribute, $value)
    {
        //return preg_match('/^(([1-6]|x)\/6)$/', $value);
    }
}
