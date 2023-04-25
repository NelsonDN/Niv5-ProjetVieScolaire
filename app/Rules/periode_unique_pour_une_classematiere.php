<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class periode_unique_pour_une_classematiere implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($periode)
    {
        //
        $this->periode = $periode;
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
        $nbre_periode = count($this->periode);
        $periodes = $this->periode;
        
        $tab = array();
        for($i=0; $i<$nbre_periode; $i++){
            $periode = explode(',',$periodes[$i]);
            array_push($tab,$periode[1]);
        }
        $nbre_tab = count(array_unique($tab));

        if($nbre_tab != $nbre_periode){
            return false;
        }else{
            return true;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Duplication d\'une meme periode pour deux matieres differentes de la classe';
    }
}
