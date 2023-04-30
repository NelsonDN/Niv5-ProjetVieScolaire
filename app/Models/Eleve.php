<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\Note;
use App\Models\Absence;



class Eleve extends Model
{
    protected $fillable = ['name', 'prename', 'date_naissance', 'sexe', 'matricule', 'classe_id', 'avatar', 'email', 'password', 'telephone', 'localisation'];

    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function evaluations()
    {
        return $this->belongsToMany(Evaluation::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}

