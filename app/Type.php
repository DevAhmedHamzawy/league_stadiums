<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [];

    public function matches()
    {
        return $this->hasMany('App\Match');
    }
}
