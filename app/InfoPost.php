<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoPost extends Model 
{

    protected $table = 'info_post';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    public function getComments()
    {
        return $this->hasMany(InfoComment::class, 'info_post_id');
    }

}