<?php

namespace App\Models;

use App\Models\Eleve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable =['nom', 'limite_eleve', 'cycle_id'];

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function cycle(){
        return $this->belongsTo(Cycle::class);
    }
    
    public function eleve(){
        return $this->belongsTo(Eleve::class);
    }

    public function matieres(){
        return $this->belongsToMany(Matiere::class)->withTimestamps();
    }
    public function enseignements(){
        return $this->belongsToMany(Enseignement::class)->withTimestamps();
    }
}

