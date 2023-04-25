<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected  $fillable = ['name' , 'etablissement_id'] ;

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }
    public function cycles()
    {
        return $this->hasMany(Cycle::class);
    }

    public function enseignements()
    {
        return $this->hasMany(Enseignement::class);
    }
}
