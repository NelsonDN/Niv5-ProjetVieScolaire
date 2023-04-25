<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;
    protected $fillable =['name','section_id'];
    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function classes(){
        return $this->hasMany(Classe::class);
    }
}
