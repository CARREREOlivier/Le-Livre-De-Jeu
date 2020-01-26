<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryRole extends Model 
{

    protected $table = 'story_role';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

}