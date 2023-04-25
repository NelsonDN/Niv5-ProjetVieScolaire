<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Section;
use App\Models\Enseignement;
use App\Models\Matiere;


class nom_unique_subject implements Rule
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
        $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();
        
        $matiere = Matiere::select('nom')->where('nom', $value)->whereIn('enseignement_id', $enseignement_id)->get();

        if ($matiere->isEmpty()){
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
        return 'Cette matière existe déjà';
    }
}
