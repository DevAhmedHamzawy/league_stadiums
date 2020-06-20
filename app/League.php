<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function groups()
    {
        return $this->hasMany('App\LeagueGroup');
    }

    // May Be Removed
    public function types()
    {
        return $this->hasMany('App\Type');
    }

    public function teams()
    {
        return $this->belongsToMany('App\User');
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }


    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();

        static::deleting(function($league) { 
             $league->comments()->delete();
             $league->matches()->delete();

        });
    }
}
