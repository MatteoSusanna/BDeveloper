<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'vote', 'text', 'lastname', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
