<?php

namespace App\Rules;
use App\Models\Cycle;
use App\Models\Section;
use Illuminate\Contracts\Validation\Rule;

class nom_unique_cycle implements Rule
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
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();

        $cycle = Cycle::select('name')->where('name', $value)->whereIn('section_id', $section_id)->get();

        if ($cycle->isEmpty()){
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
        return 'Ce cycle existe déjà ';
    }
}
