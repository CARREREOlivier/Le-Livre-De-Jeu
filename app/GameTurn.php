<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameTurn extends Model 
{

    protected $table = 'gameturns';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}