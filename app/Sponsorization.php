<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorization extends Model
{
    protected $fillable = ['name', 'price', 'duration'];

    public function user(){
        return $this->belongsToMany('App\User')->withPivot('start_date');
    }
}
