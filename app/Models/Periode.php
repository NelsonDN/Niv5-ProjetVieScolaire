<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $fillable = ['jour', 'heure_debut', 'heure_fin', 'groupeperiode_id'];

    public function etablissement(){
        return $this->belongsTo(Etablissement::class);
    }

    public function jours()
    {
        return $this->belongsToMany(Jour::class)->withTimestamps();
    }

    public function groupeperiode()
    {
        return $this->belongsTo(Groupeperiode::class);
    }
}
