<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'title',
        'body',
        'category_id',
        'photo_id',
        'slug'
    ];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function getTitleAttribute($title){
        return ucfirst($title);
    }

    public function getBodyAttribute($body){
        return ucfirst($body);
    }
}



