<?php

namespace App\Http\Controllers;

use App\Factories\GameRoleFactory;
use App\Factories\GameSessionFactory;
use App\GameRole;
use App\GameSession;
use App\GameTurn;
use App\Mail\TurnNotification;
use App\TurnOrder;
use App\Upload;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;


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

        return view('gamesessions.gameSessionIndex')
            ->with('gamesessions', $gameSessions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        /**
         * the view requires the users to be added in a table for the app user convenience
         *
         */
        if (isset (Auth::user()->id)) {
            $users = $this->getPotentialPlayers();

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
            'description' => 'max:21844', // text is 65535 bytes. utf8 take 3 bytes per character. Hence the maximum character number is 65535/3=21845.
            // And I take one character off to make the string will fit into the text field
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

        //getting players with game role
        $players = GameRole::with('getUsers:id,name')
            ->where("gamesession_id", "=", $gameSession->id)
            ->where('gamerole', '=', 'GameParticipant')
            ->get();

        $gameMaster = GameRole::with('getUsers:id,name')
            ->where("gamesession_id", "=", $gameSession->id)
            ->where("gamerole", '=', 'GameMaster')
            ->get();

        if (Auth::check()) {
            $users = $this->getPotentialPlayers();
            foreach ($players as $player) {

                foreach ($users as $user) {

                    if ($player->user_id == $user->id) {

                        $user->checked = 'true';
                    }
                };
            }

        }
        $gameTurns = GameTurn::where('gamesessions_id', $gameSession->id)->get();//TODO: correct column nam//$turnOrders = TurnOrder::where('gameTurn_id',$gameSession->id)->get();
        $lastTurn = $gameTurns->last();

        if (isset($lastTurn)) {
            $last = $lastTurn->id;
        } else {
            $last = -1;
        }

        $orders = GameTurn::where('gamesessions_id', $gameSession->id)
            ->join('turnorders', 'turnorders.gameturn_id', '=', 'gameturns.id')
            ->join('users', 'turnorders.user_id', '=', 'users.id')
            ->select('gameturns.*', 'users.*', 'turnorders.*', 'turnorders.created_at as orderDate')
            ->get()
            ->makeHidden(['email', "email_verified_at", "password", "remember_token"]);

        $canSendOrder = $this->canSendOrder($last);

        if (Auth::check()) {
            return view('gamesessions.gameSessionShow')
                ->with('gameSession', $gameSession)
                ->with('gameTurns', $gameTurns)
                ->with('orders', $orders)
                ->with('canSendOrder', $canSendOrder)
                ->with('lastTurnId', $last)
                ->with('players', $players)
                ->with('gamemaster', $gameMaster)
                ->with('users', $users);

        } else {
            return view('gamesessions.gameSessionShow')
                ->with('gameSession', $gameSession)
                ->with('gameTurns', $gameTurns)
                ->with('orders', $orders)
                ->with('canSendOrder', $canSendOrder)
                ->with('lastTurnId', $last)
                ->with('players', $players)
                ->with('gamemaster', $gameMaster);
        }
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
        if (Gate::allows('gamesession.edit', $gameSession)) {
            $gameSessionId = $gameSession->id;

            $users = $this->getPotentialPlayers();

            //getting players with game role
            $players = GameRole::with('getUsers:id,name')
                ->where("gamesession_id", "=", $gameSessionId)
                ->where('gamerole', '=', 'GameParticipant')
                ->get();

            $gameMasters = GameRole::with('getUsers:id,name')
                ->where("gamesession_id", "=", $gameSessionId)
                ->where('gamerole', '=', 'GameMaster')
                ->get();

            foreach ($players as $player) {

                foreach ($users as $user) {

                    if ($player->user_id == $user->id) {

                        $user->checked = 'true';
                    }
                };
            }

            //returning the view with gamesession
            return view('gamesessions.gameSessionEdit')
                ->with('gameSession', $gameSession)
                ->with('users', $users)
                ->with('players', $players)
                ->with('gamemasters', $gameMasters);

        } else return view('utils.authentificationRequired');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return GameSessionController
     */
    public function update(Request $request, $id)
    {


        $gamesession = GameSession::findOrFail($id);//findorfail avoids to write a bit of code to launch a 404page if query fails.
        if (Gate::allows('gamesession.update', $gamesession)) {
            // The current user can update the gamesession...


            $gameSessionId = $id;//for clarity later in the code

            //update gamesession
            $gamesession->title = $request->title;
            $gamesession->game = $request->game;
            $gamesession->description = $request->description;
            $gamesession->slug = str_slug($request->title);

            $gamesession->save();

            //update players
            //simplest way : delete all GameParticipant bound to the gamesession and insert new entries
            $players = GameRole::with('getUsers:id,name')
                ->where("gamesession_id", "=", $gameSessionId)
                ->where('gamerole', '=', 'GameParticipant')
                ->get();

            foreach ($players as $player) {

                GameRole::find($player->id)->delete();

            }

            //Assigning GameParticipants (if any) to gamesession
            $playersUpdate = $request['checkBox'];
            if (isset($playersUpdate)) {
                foreach ($playersUpdate as $playerUpdate) {
                    $gameRole = GameRoleFactory::build($playerUpdate, $gameSessionId, 'GameParticipant');
                    $gameRole->save();
                }
            }


            //return to view to visually check the update
            return $this->show($gamesession->slug);
        } else  return view('home');
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

    /**
     * function to get users and trusted users.
     * Avoids code repetition.
     *
     * @return mixed
     */
    function getPotentialPlayers($gameSessionId = null)
    {

        //removing GameMaster from list if there is an existing gamemaster.
        // GameMasters are not updated through the gamesessions' views but through a specific view.
        if (isset($gameSessionId)) {

            $gameMaster = GameRole::with('getUsers:id,name')
                ->where("gamesession_id", '=', $gameSessionId)
                ->where('gamerole', '=', 'GameMaster')
                ->get();

            $users = User::where("status", '=', 'User')
                ->where('id', '!=', $gameMaster->user_id)
                ->get();


        } else {
            //getting users to populate list
            $users = User::where("status", '=', 'User')
                ->where('id', '!=', Auth::user()->id)//if the script goes here it means the gamesession is to be created. The current user is the creator of the gamesession.
                ->get();

        }

        return $users;
    }


    function canSendOrder($last)
    {

        //if the user is logged in, (s)he must have an id then:
        if (isset(Auth::user()->id)) {//If N1

            $userId = Auth::user()->id;


            //checking if user last order has the last turn id
            $userOrders = TurnOrder::where('user_id', $userId)->where('gameturn_id', $last)->get();
            // var_dump($userOrders);


            //if Yes, it means the user has posted an order corresponding to the last turn.
            // Hence it does not have to post a new order.
            //If No, it means the user is either new to the gamesession or has not posted order on the last turn.
            if (isset($userOrders[0])) {//if N2
                return $canSendOrder = false;
            } else {
                return $canSendOrder = true;
            }//If N2
        } else { //if the user is not logged in:
            return $canSendOrder = false;
        }
    }


    public function mailToPlayers($gameTurnId)
    {

        //finding the turn
        $gameTurn = GameTurn::find($gameTurnId);

        //retrieving gameSessionId
        $gameSessionId = $gameTurn->gamesessions_id;

        //finding the associated players-not the gamemaster as he/she creates the new turn.

        $players = GameRole::with('getUsers:id,name,email')
            ->where("gamesession_id", "=", $gameSessionId)
            ->where('gamerole', '=', 'GameParticipant')
            ->get();

        if ($players->count()>0) {
            //getting sender mail and name
            $user_email = Auth::user()->email;
            $user_name = Auth::user()->name;


            //looping through player to send
            foreach ($players as $player) {

                //getting player mail and name
                $player_mail = $player->getusers->email;
                $player_name = $player->getusers->name;

                //instantiating mailable object
                $email = new \stdClass();
                $email->message = $gameTurn->description;
                $email->sender = "$user_name : $user_email";
                $email->attachment = $user_email;
                $email->receiver = $player_name;
                $email->subject = $gameTurn->title;

                //Send Mail
                Mail::to($player_mail)->send(new TurnNotification($email));

                //cleaning memory-php should do it anyway but who knows?
                unset($email);
            }//Endforeach $players

            //redirect back with message
            return redirect()->back()->with('message', "la notification a été envoyé aux joueurs! ");
        } else {

            return redirect()->back()->with('message', "Merci d'ajouter un joueur");
        }

    }
}


?>