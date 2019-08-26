<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $guarded = [];

    public function stadium()
    {
        return $this->belongsTo('App\Stadium');
    }

    public function statistics()
    {
        return $this->hasOne('App\MatchStatistic');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->whereNull('parent_id');
    }

    public function league()
    {
        return $this->belongsTo('App\League');
    }

}
