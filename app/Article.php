<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use \Spatie\Tags\HasTags;

    protected $guarded = [];
}
