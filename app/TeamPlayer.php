<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    protected $guarded = [];

    public function player(){
        return $this->hasOne('App\user','id','player_id');
    }

    public function team(){
        return $this->belongsTo('App\user');
    }

}
