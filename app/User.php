<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    public function specialization(){
        return $this->belongsToMany('App\Specialization',);
    }

    public function skill(){
        return $this->belongsToMany('App\Skill');
    }

    public function sponsorization(){
        return $this->belongsToMany('App\Sponsorization')->withPivot('starts_at', 'ends_at');
    }

    public function message(){
        return $this->hasMany('App\Message');
    }

    public function review(){
        return $this->hasMany('App\Review');
    }


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'lastname', 'address', 'curriculum', 'phone', 'cover', 'slug', 'hourly_wage'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
