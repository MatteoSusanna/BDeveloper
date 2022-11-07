<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = ['curriculum', 'phone', 'cover', 'slug', 'hourly_wage', 'user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
