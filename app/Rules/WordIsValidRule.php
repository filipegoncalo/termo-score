<?php

namespace App\Rules;

use App\Models\WordOfDay;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WordIsValidRule implements ValidationRule
{
    public function __construct(protected string $gameId)
    {
        //
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = WordOfDay::query()
        ->where('game_id', str($this->gameId)->replace('#', ''))
        ->where('word', $value);
        if (!$exists) {
            $fail('game_id nao exist');
        }
    }
}
