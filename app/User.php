<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'role_id',
        'is_active',
        'photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
    // public function hasRole()
    // {
    //     // dd($this->roles->name);
    //     if($this->roles->name == 'Administrator'){
    //         return true;
    //     }
    //     return false;
    // }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    // public function isAdmin(){
    //     if($this->roles->name == "Administrator" && $this->is_active == 1){
    //         return true;
    //     }
    //     return false;
    // }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    // public function setPasswordAttribute($password){
    //     if(!empty($password)){
    //         $this->attributes['password'] = bcrypt($password);
    //     }
    // }

    public function getNameAttribute($name){
        return ucfirst($name);
    }

    public function getEmailAttribute($email){
        return ucfirst($email);
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
