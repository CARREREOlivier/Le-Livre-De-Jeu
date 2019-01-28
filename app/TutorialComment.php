<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TutorialComment extends Model 
{

    protected $table = 'tutorials_comments';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

}