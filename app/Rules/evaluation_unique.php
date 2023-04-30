<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Evaluation;

class evaluation_unique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail)
    {
        $etablissement_id=auth()->user()->etablissement_id;

        $name = Evaluation::select('name')->where('name', $value)->where('etablissement_id', $etablissement_id)->get();

        if ($name->isEmpty()){
            return true;
        }

        return false;
    }
}
