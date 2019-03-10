<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text','user_id','room_id'];

    public function rooms(){
        return $this->belongsToMany('App\Room');
    }

}
