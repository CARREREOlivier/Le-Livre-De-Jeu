<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model 
{

    protected $table = 'infos';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    public function getPosts()
    {
        return $this->hasMany('InfoPost', 'info_id');
    }

}