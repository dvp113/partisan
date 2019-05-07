<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'post';
    protected $fillable = ['title', 'slug', 'content', 'author_name', 'view'];
    protected $guard = [];
}
