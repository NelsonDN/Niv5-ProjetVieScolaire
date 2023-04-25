<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cahierdetexte extends Model
{
    use HasFactory;
    
    protected $fillable=['titre','contenu', 'piece_jointe', 'classe_matiere_id','typedecour_id'];

    public function typedecour()
    {
        return $this->belongsTo(typedecour::class);
    }



}
