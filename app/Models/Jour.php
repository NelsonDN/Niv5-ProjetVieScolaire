<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Jour extends Model
{
    use HasFactory;

    protected $fillable =['jour', 'etablissement_id','groupeperiode_id'];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function periodes()
    {
        return $this->belongsToMany(Periode::class)->withTimestamps()->withPivot(['isbreak']);
    }
    public function groupeperiode()
    {
        return $this->belongsTo(Groupeperiode::class);
    }
}
