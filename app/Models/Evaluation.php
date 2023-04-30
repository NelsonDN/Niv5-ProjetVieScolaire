<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eleve;
use App\Models\Note;

class Evaluation extends Model
{
    protected $fillable = ['name', 'etablissement_id'];
    use HasFactory;

    public function eleves()
    {
        return $this->belongsToMany(Eleve::class);
    }

    public function notes()
    {
        return $this->HasMany(Note::class);
    }
}
