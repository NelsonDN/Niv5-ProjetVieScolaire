<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annee_Scolaire extends Model
{
    use HasFactory;

    public function etablissement(){
        return $this->hasMany(Etablissement::class);
    }

}
