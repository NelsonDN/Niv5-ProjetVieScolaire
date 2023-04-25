<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupeperiode extends Model
{
    use HasFactory;

    protected $fillable = ['heure_debut', 'heure_fin', 'duree_periode', 'nbre_pause', 'etablissement_id'];

    public function periodes()
    {
        return $this->hasMany(Periode::class);
    }

    public function pauses()
    {
        return $this->hasMany(Periode::class);
    }

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function jours()
    {
        return $this->hasMany(Jour::class);
    }
}
