<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorialPost extends Model 
{

    protected $table = 'tutorial_post';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    public function getComments()
    {
        return $this->hasMany('TutorialComment', 'tutorial_post_id');
    }

}