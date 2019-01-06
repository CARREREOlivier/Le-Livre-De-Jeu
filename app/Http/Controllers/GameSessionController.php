<?php

namespace App\Http\Controllers;

use App\Factories\GameRoleFactory;
use App\Factories\GameSessionFactory;
use App\GameSession;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameSessionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $gameSessions = GameSession::with('getUserNames:id,name')->get();


        return view('gamesessions.gameSessionIndex')->with('gamesessions', $gameSessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        /**
         * the view requires the users to be added in a table for the app user convenience
         *
         */
        if (isset (Auth::user()->id)) {
            $users = User::where("status", '=', 'User')
                ->orWhere("status", '=', 'Trusted User')
                ->get();

            return view('gamesessions.gameSessionsNew')->with('users', $users);
        } else {
            return view('utils.authentificationRequired');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        //Validation
        $validatedData = $request->validate([
            'title' => 'required|unique:gamesessions|max:125',
            'game' => 'max:50',
            'description' => 'max:1024',
        ]);


        //Game Session Creation
        $gameSession = GameSessionFactory::build($request);
        $gameSession->save();

        //Storing gameSession ID for use
        $gameSessionId = $gameSession->id;

        //Assigning GameMaster to gamesession
        $gameRole = GameRoleFactory::build($gameSession->user_id, $gameSessionId, 'GameMaster');
        $gameRole->save();

        //Assigning GameParticipants (if any) to gamesession
        $users = $request['checkBox'];
        if (isset($users)) {
            foreach ($users as $user) {
                $gameRole = GameRoleFactory::build($user, $gameSessionId, 'GameParticipant');
                $gameRole->save();
            }
        }
        //returning view
        return redirect()->route('gamesession.index');

    }

    /**
     *  Display the specified resource.
     *
     * @param $slug
     * @return $this
     */

    public function show($slug)
    {

        $gameSession = GameSession::where('slug', $slug)->first();


        return view('gamesessions.gameSessionShow')->with('gameSession', $gameSession);

    }

    /**
     * Show the form for editing the specified resource.
     * @param $slug
     * @return $this
     */

    public function edit($slug)
    {
        //getting concerned gamesession for sending its data back to user
        $gameSession = GameSession::where('slug', $slug)->first();

        //returning the view with gamesession
        return view('gamesessions.gameSessionEdit')->with('gamesession', $gameSession);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($slug)
    {
        //deleting entry
        GameSession::where('slug', $slug)->first()->delete();

        //returning view
        return redirect()->route('gamesession.index');

    }

}

?>