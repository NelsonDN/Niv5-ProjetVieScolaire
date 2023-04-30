<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eleve;
use App\Models\Typedecour;
use App\Models\Matiere;

class Absence extends Model
{
    protected $fillable = ['matiere_id', 'eleve_id', 'justifier', 'date_seance', 'typedecour_id'];
    
    use HasFactory;

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }

    public function typedecour()
    {
        return $this->belongsTo(Typedecour::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

}
