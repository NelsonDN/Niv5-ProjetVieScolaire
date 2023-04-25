<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $fillable=['nom', 'enseignement_id'];

    public function enseignement()
    {
        return $this->belongsTo(Enseignement::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function classes()
    {
        return $this->belongsToMany(Classe::class)->withTimestamps()->withPivot(['coefficient', 'user_id']);
    }

}
