<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorizationUser extends Model
{
    /**
     * The users that belong to the role.
     */
    public function sponsorizationUser()
    {
        return $this->belongsTo('App\User', "starts_at", "ends_at");
    }

    
    protected $fillable = [
        'starts_at', 'ends_at'
    ];
    
}
