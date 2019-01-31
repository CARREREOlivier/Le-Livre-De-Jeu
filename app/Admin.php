<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Model
{
    use Notifiable;

    protected $admin;
    protected $email;

    public function __construct() {
        $this->admin = config('admin.name');
        $this->email = config('admin.email');
    }
}
