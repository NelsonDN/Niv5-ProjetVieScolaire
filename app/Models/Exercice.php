<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    use HasFactory;

    protected $fillable =['titre', 'date_de_correction', 'contenu', 'piece_jointe', 'cahierdetexte_id'];

    public function cahierdetexte()
    {
        return $this->belongsTo(Cahierdetexte::class);
    }
}
