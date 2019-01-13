<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TurnOrder extends Model 
{

    protected $table = 'turnorders';
    public $timestamps = true;
    protected $fillable = ['message'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}