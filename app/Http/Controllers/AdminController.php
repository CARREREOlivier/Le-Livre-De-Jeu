<?php

namespace App\Http\Controllers;

use App\GameSession;
use App\GameTurn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::all();
        $gameSessions = GameSession::all();
        $gameTurns = GameTurn::all();

        return View('admin.admin')
            ->with('users', $users)
            ->with('gameSessions', $gameSessions)
            ->with('gameTurns', $gameTurns);


    }

    public function addUser()
    {


    }

    public function updateUser(Request $request, $id)
    {


        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;

        switch ($request->status)
        {
            case 0:
                $user->status = 'Admin';
                break;
            case 1:
                $user->status = 'User';
                break;
        }
        $user->save();

        return redirect()->back();
    }


    public function editGameSession($id){

        $gameSession = GameSession::find($id);

        return View('admin.admin')->with('gameSession', $gameSession);

    }
    public function updateGameSession(Request $request){

        $gameSession = GameSession::find($request->id);

        $gameSession->title = $request->title;
        $gameSession->description = $request->description;
        $gameSession->save();

        $message = "la partie a été éditée correctement";


        return redirect()->route('admin.main')->with('message',$message);

    }

    public function editGameTurn($id){

        $gameTurn = GameTurn::find($id);

        return View('admin.admin')->with('gameTurn', $gameTurn);

    }
    public function updateGameTurn(Request $request){

        $gameTurn = GameTurn::find($request->id);

        $gameTurn->title = $request->title;
        $gameTurn->description = $request->description;
        $gameTurn->long_description = $request->long_description;
        $gameTurn->save();

        $message = "le tour a été édité correctement";


        return redirect()->route('admin.main')->with('message',$message);

    }

}
