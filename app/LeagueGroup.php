<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueGroup extends Model
{
    protected $guarded = [];

    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
