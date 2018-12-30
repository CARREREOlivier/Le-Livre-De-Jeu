<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoComment extends Model 
{

    protected $table = 'infos_comments';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}