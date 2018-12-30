<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Story extends Model 
{

    protected $table = 'stories';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function getPosts()
    {
        return $this->hasMany('StoryPost', 'story_id');
    }

    public function getStoryRoles()
    {
        return $this->hasMany('StoryRole', 'story_id');
    }

}