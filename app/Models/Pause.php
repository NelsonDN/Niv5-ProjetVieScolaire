<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pause extends Model
{
    use HasFactory;

    protected $fillable = ['nbre_periode_avant', 'duree_pause', 'groupeperiode_id'];

    public function groupeperiode()
    {
        return $this->belongsTo(Groupeperiode::class);
    }
}
