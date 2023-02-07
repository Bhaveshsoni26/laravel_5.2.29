<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function photos(){
        return $this->hasMany('App\Photo');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function categories(){
        return $this->hasMany('App\Category');
    }

    public function getNameAttribute($name){
        return ucfirst($name);
    }
}

