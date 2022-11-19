<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorization extends Model
{
    protected $fillable = ['name', 'price', 'duration'];

    public function user(){
        return $this->belongsToMany('App\User','sponsorization_user', 'user_id', 'sponsorization_id')->withPivot('starts_at', 'ends_at')->using('App\SponsorizationUser');
    }
}
