<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setPostImageAttribute($value){
        $this->attributes['post_image'] = asset('/storage/' . $value);
    }

    public function getPostImageAttribute($value)
    {
        return asset($value);
    }

}
