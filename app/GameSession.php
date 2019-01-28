<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameSession extends Model 
{

    protected $table = 'gamesessions';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    protected $fillable = ['title', 'game', 'description'];

    public function getUserNames(){

        return $this->belongsTo('App\User', "user_id");

    }

    public function getTurns()
    {
        return $this->hasMany('GameTurn', 'gamesession_id');
    }

    public function getComments()
    {
        return $this->hasMany('GameSessionComment', 'gamesession_id');
    }

    public function getGameRoles()
    {
        return $this->hasMany('GameRole', 'gamesession_id');
    }

}