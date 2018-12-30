<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoryPost extends Model 
{

    protected $table = 'story_posts';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function getComments()
    {
        return $this->hasMany('StoryComment', 'story_id');
    }

}