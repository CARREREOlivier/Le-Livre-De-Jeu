<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutorial extends Model 
{

    protected $table = 'tutorials';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    public function getPosts()
    {
        return $this->hasMany('TutorialPost', 'tutorial_id');
    }

}