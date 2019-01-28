<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model 
{

    protected $table = 'uploads';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

}