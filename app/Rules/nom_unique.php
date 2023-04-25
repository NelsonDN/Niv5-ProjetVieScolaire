<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Section;
use App\Models\Classe;
use App\Models\Cycle;

class nom_unique implements Rule
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
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();

        $classe = Classe::select('nom')->where('nom', $value)->whereIn('cycle_id', $cycle_id)->get(); 
        
        if ($classe->isEmpty()){
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
        return 'Cette classe  existe déjà ';
    }
}
