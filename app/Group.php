<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    public function leagueGroups(){
        return $this->hasMany('App\leaguegroup');
    }
}
