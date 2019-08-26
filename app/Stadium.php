<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Stadium extends Model
{
    use Searchable;

    protected $table = 'stadiums';
    protected $guarded = [];

    public function leagues()
    {
        return $this->hasMany('App\League');    
    }

    public function images()
    {
        return $this->hasMany('App\StadiumImage');
    }

    public function match()
    {
        return $this->hasOne('Match');
    }

}
