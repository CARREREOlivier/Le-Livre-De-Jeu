<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoryComment extends Model 
{

    protected $table = 'stories_comments';
    public $timestamps = true;


    protected $dates = ['deleted_at'];


}