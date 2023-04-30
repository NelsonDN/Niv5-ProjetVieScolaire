<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Matiere;


class Note extends Model
{
    protected $fillable = ['note', 'eleve_id', 'matiere_id', 'evaluation_id'];

    use HasFactory;

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
    
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

}
