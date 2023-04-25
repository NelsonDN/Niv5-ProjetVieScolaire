<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typedecour extends Model
{
    use HasFactory;
    
    protected $fillable=['nom', 'etablissement_id'];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }
    public function cahierdetextes()
    {
        return $this->hasMany(Cahierdetexte::class);
    }
}
