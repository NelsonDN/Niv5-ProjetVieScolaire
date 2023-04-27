<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\User;

class Eleve extends Model
{
    protected $fillable = ['name', 'prename', 'date_naissance', 'sexe', 'matricule', 'classe_id', 'avatar', 'email', 'password', 'telephone', 'localisation'];

    use HasFactory;

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    
    public function users()
    {
        return $this->belongsToMany(Parent::class);
    }
}

