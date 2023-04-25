<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Section;

class nom_unique_section implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $etablissement_id=auth()->user()->etablissement_id;
        $section_id = Section::select('name')->where('name', $value)->where('etablissement_id', $etablissement_id)->get();

        if ($section_id->isEmpty()){
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cette section existe déjà ';
    }
}
