<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use Laravel\Scout\Searchable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, SoftDeletes, EntrustUserTrait, Searchable;

    use SoftDeletes, EntrustUserTrait {

        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;

    }


    protected $guarded = [];


    protected $hidden = ['password', 'remember_token', 'activation_token'];
    protected $casts = ['email_verified_at' => 'datetime'];

    protected $dates = ['deleted_at'];
    protected $appends = ['avatar_url'];
    

    public function position()
    {
        return $this->hasOne('Position');
    }

    public function statistics()
    {
        return $this->hasOne('PlayerStatistic');
    }

    public function leagues()
    {
        return $this->hasMany('App\League');
    }

    public function leagueStatistics()
    {
        return $this->hasOne('PlayerLeagueStatistics');
    }

    public function matchStatistics()
    {
        return $this->hasOne('PlayerMatchStatistics');
    }

    public function stadiums()
    {
        return $this->hasMany('Stadium');
    }

    public function team(){
        return $this->hasOne('App\User');
    }

    public function players(){
        return $this->hasMany('App\User');
    }

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    public function getAvatarUrlAttribute()
    {
        return Storage::disk('user')->url('users/images/'.$this->avatar);
    }

    // May Be Removed
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
   
   
    

}