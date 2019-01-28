<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameTurn extends Model 
{

    protected $table = 'gameturns';
    public $timestamps = true;


    protected $dates = ['deleted_at'];


    function getOrders(){

        return $this->hasMany('TurnOrder','user_id');

    }

}