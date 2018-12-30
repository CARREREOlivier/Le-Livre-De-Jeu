<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoPost extends Model 
{

    protected $table = 'info_post';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function getComments()
    {
        return $this->hasMany('InfoComment', 'info_post_id');
    }

}