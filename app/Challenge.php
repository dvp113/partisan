<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    //
    protected $table = 'challenge';
    protected $fillable = ['title', 'description', 'max_score'];
    protected $guard = [];
}
