<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StadiumImage extends Model
{
    protected $guarded = [];

    public function stadium()
    {
        return $this->belongsTo('Stadium');
    }

}
