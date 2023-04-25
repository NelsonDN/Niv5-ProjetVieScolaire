<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignement extends Model
{
    use HasFactory;
    protected  $fillable = ['name', 'section_id'] ;
    
    public function matieres(){
        return $this->hasMany(Maniere::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function classes(){
        return $this->belongsToMany(Classe::class);
    }

}
