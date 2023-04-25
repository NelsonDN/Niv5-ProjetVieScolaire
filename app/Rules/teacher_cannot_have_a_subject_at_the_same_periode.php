<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use App\Models\Classe;
use App\Models\Matiere;
use Illuminate\Support\Facades\DB;

class teacher_cannot_have_a_subject_at_the_same_periode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($matieres)
    {
        //
        $this->matiere = $matieres;
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
        $matieres = $this->matiere;

        $periodes = array();
        foreach($matieres as $matiere)
        {
            $classe_matiere = explode(',',$matiere);
            $matiere_id = $classe_matiere[0];
            $classe_id = $classe_matiere[1];

            $classe_matiere_id = DB::table('classe_matiere')->select('id')->where('classe_id',$classe_id)->where('matiere_id', $matiere_id)->first();
            $jour_periode_id = DB::table('classmat_jourperiode')->select('jour_periode_id')->where('classe_matiere_id', $classe_matiere_id->id)->get();

            foreach($jour_periode_id as $id_periode){

                if(!in_array($id_periode->jour_periode_id, $periodes)){                    
                    array_push($periodes, $id_periode->jour_periode_id);
                }else{
                    return false;
                }

            }

        }
        return true;
        // dd($periodes,$matieres);


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Un enseignant ne peut pas dispenser des matières le meme jour à la même période';
    }
}
