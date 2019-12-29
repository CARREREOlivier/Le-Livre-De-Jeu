<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoComment extends Model 
{

    protected $table = 'infos_comments';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    protected $with = ['user'];

    public function post()
    {
        return $this->belongsTo(InfoPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}