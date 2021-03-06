<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{

    protected $fillable = ['title', 'body', 'status', 'img', 'user_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }


    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

}
