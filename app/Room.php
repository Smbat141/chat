<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name','text','image','status','user_id','key'];

    public function comments(){
        return $this->hasMany('App\Room');
    }

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
