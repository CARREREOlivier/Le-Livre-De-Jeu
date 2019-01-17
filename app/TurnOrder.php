<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TurnOrder extends Model 
{

    protected $table = 'turnorders';
    public $timestamps = true;
    protected $fillable = ['message'];

    protected $dates = ['deleted_at'];

}