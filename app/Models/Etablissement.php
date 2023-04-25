<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    protected $fillable=['nom', 'email', 'localisation', 'bp', 'telephone'];

    public function users(){
        return $this->hasMany(User::class);
    }
    
    public function sections(){
        return $this->hasMany(Section::class);
    }

    public function annee_scolaires(){
        return $this->hasMany(Annee_Scolaire::class);
    }

    public function jours(){
        return $this->hasMany(Jour::class);
    }

    public function periodes(){
        return $this->hasMany(Periode::class);
    }
    

    public function groupeperiodes(){
        return $this->hasMany(Annee_Scolaire::class);
    }

    public function typedecours(){
        return $this->hasMany(Typedecour::class);
    }


}
