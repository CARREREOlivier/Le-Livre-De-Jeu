<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryComment extends Model 
{

    protected $table = 'stories_comments';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

}