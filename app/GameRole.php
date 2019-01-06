<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameRole extends Model 
{

    protected $table = 'gamerole';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function getUsers(){

        return $this->belongsTo('App\User', "user_id");

    }



}