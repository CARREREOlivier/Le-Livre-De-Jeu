<?php

namespace App\Http\Controllers;

use App\GameSession;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::all();
        $gameSessions = GameSession::all();

        return View('admin.admin')
            ->with('users', $users)
            ->with('gameSessions', $gameSessions);


    }
}
