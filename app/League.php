<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function groups()
    {
        return $this->hasMany('App\LeagueGroup');
    }

    // May Be Removed
    public function types()
    {
        return $this->hasMany('Type');
    }

    public function teams()
    {
        return $this->belongsToMany('App\User');
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }
}
