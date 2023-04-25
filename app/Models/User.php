<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable , SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'avatar'
    ];

    public function etablissement(){
        
        return $this->belongsTo(Etablissement::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // /**
    //  * The attributes that should be mutated to dates.
    //  *
    //  * @var array
    //  */
    // protected $dates = ['deleted_at'];

    // public function getAvatarAttribute($value)
    // {
    //     if (!$value) {
    //         //return 'http://placehold.it/160x160';
    //         return url('/') . config('variables.avatar.public') . 'avatar0.png';
    //     }

    //     return url('/') . config('variables.avatar.public') . $value;
    // }

    // public function setAvatarAttribute($photo)
    // {
    //     $this->attributes['avatar'] = move_file($photo, 'avatar.image');
    // }

    // public function setPasswordAttribute($value='')
    // {
    //     $this->attributes['password'] =  Hash::make($value);
    // }

    // public function role()
    // {
    //     return $this->belongsToMany(Role::class, 'role_user');
    // }

    // // public function matieres()
    // // {
    // //     return $this->hasMany(Matiere::class);
    // // }

}
