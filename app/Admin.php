<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class Admin extends Authenticatable
{
    use EntrustUserTrait;

    protected $guarded = [];

    public function getAvatarUrlAttribute()
    {
        return Storage::disk('user')->url('users/images/'.$this->avatar);
    }
}
