<?php

namespace App\Http\Controllers;

use App\Factories\GameRoleFactory;
use App\Factories\GameSessionFactory;
use App\Factories\TurnOrderFactory;
use App\GameRole;
use App\GameSession;
use App\GameTurn;
use App\Mail\TurnNotification;
use App\TurnOrder;
use App\Upload;
use App\User;
use App\Utils\DataFinder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;


class GameSessionController extends Controller
{


    public function __construct(DataFinder $dataFinder)
    {
        $this->dataFinder = $dataFinder;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $gameSessions = GameSession::with('getUserNames:id,username')->get();

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
            'game' => 'required|max:50',
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

        //1-Finding gameSession
        $gameSession = GameSession::where('slug', $slug)->first();

        //2-retrieving players and gamesession
        $gameSessionId = $gameSession->id;
        $players = $this->dataFinder->getPeople('GameParticipant', $gameSessionId);
        $gameMaster = $this->dataFinder->getPeople('GameMaster', $gameSessionId);


        //If current user is Admin or gamemaster
        //we need to send the list of current players to the players list.

        if (Auth::check()) {//FIXME: wrong condition.
            $users = $this->getPotentialPlayers();
            foreach ($players as $player) {
                foreach ($users as $user) {
                    if ($player->user_id == $user->id) {
                        $user->checked = 'true';
                    }
                };
            }
        } else {
            $users = null;
        }

        $gameTurns = GameTurn::where('gamesessions_id', $gameSessionId)->get();

        $lastTurn = $gameTurns->last();
        if (isset($lastTurn)) {
            $last = $lastTurn->id;
            $gameMasterFiles = Upload::where('category', 'gameturns')
                ->where('entity_id', $last)
                ->where('user_id', $gameMaster->last()->getusers->id)
                ->get();


        } else {
            $last = -1;//No turns. -1 is a non existing id that will never be found in the database.
            $gameMasterFiles = null;
        }

        $orders = GameTurn::where('gamesessions_id', $gameSession->id)
            ->join('turnorders', 'turnorders.gameturn_id', '=', 'gameturns.id')
            ->join('users', 'turnorders.user_id', '=', 'users.id')
            ->select('gameturns.*', 'users.*', 'turnorders.*', 'turnorders.created_at as orderDate')
            ->get()
            ->makeHidden(['email', "email_verified_at", "password", "remember_token"]);


        $orders = $orders->keyBy('user_id');

        $orderFileExists = $this->orderFileExists($orders);


        return View('gamesessions.gameSessionShow')
            ->with('gameSession', $gameSession)
            ->with('gameTurns', $gameTurns)
            ->with('players', $players)
            ->with('gamemaster', $gameMaster)
            ->with('users', $users)
            ->with('lastTurnId', $last)
            ->with('orders', $orders)
            ->with('gameMasterFiles', $gameMasterFiles)
            ->with('orderFileExists', $orderFileExists);
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

            //getting players and game master with game role
            $players = $this->dataFinder->getPeople('GameParticipant', $gameSessionId);
            $gameMasters = $this->dataFinder->getPeople('GameMaster', $gameSessionId);


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
            $players = $this->dataFinder->getPeople('GameParticipant', $gameSessionId);


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

            //Adding new players to last turn (the last turn one is the only one allowing to change players :)
            $gameTurns = GameTurn::where('gamesessions_id', $gameSessionId)->get();
            $lol = $gameTurns->count();

            //refresh players' collection
            $players = $this->dataFinder->getPeople('GameParticipant', $gameSessionId);

            if ($gameTurns->count() > 0) {

                $lastTurn = $gameTurns->last()->id;
                $turnOrders = TurnOrder::where('gameturn_id', $lastTurn)->get();

                foreach ($players as $player) {
                    $hasOrder = false;
                    foreach ($turnOrders as $turnOrder) {
                        if ($player->user_id == $turnOrder->user_id) {
                            $hasOrder = true;
                            break;
                        }
                    }

                    if ($hasOrder == false) {

                        $order = TurnOrderFactory::build($lastTurn, $player->user_id);
                        $order->save();
                    }
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
            $gameMaster = $this->dataFinder->getPeople('GameMaster', $gameSessionId);

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
                $canSendOrder = false;
                return $canSendOrder;

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

        //finding the associated players-

        $players = $this->dataFinder->getPeople('GameParticipant', $gameSessionId);

        //files to attach
        $files = Upload::where('category', 'gameturns')
            ->where('entity_id', $gameTurnId)
            ->get();

        if ($players->count() > 0) {
            //getting sender mail and name
            $user_email = Auth::user()->email;
            $user_name = Auth::user()->username;

            //building link to gamesession
            $gameSession = GameSession::find($gameSessionId);
            $slug = $gameSession->slug;

            $link = config('app.url') . "/gamesession/" . $slug;

            //building subject
            //assessing turn number
            $turn_number = $this->turnPosition($gameTurn, $gameSessionId);
            $title = $gameSession->title;
            $subject = "Tour " . $turn_number . " : " . $title;

            //looping through player to send
            foreach ($players as $player) {

                //getting player mail and name
                $player_mail = $player->getusers->email;
                $player_name = $player->getusers->username;

                //instantiating mailable object
                $email = $this->createEmail($gameTurn, $player_mail, $player_name, $user_name, $user_email, $subject, $link);


                //Send Mail to player
                $this->sendMail($email, $files);


                //cleaning memory-php should do it anyway but who knows?
                unset($email);
            }//Endforeach $players


            //gamemaster

            $players = $this->dataFinder->getPeople('GameMaster', $gameSessionId);
            $player = $players->last();

            //getting player mail and name
            $player_name = $player->getusers->username;
            $player_mail = $player->getusers->email;


            //instantiating mailable object
            $email = $this->createEmail($gameTurn, $player_mail, $player_name, $user_name, $user_email, $subject, $link);


            //sending notification to gamemaster as feedback.
            $this->sendMail($email, $files);


            //cleaning memory-php should do it anyway but who knows?
            unset($email);

            //redirect back with message
            return redirect()->back()->with('message', "la notification a été envoyé aux joueurs! ");
        } else {
            return redirect()->back()->with('message', "Merci d'ajouter un joueur");
        }

    }


    /**
     *
     * This method  asses the current turn position
     * regarding the others turns of the considered gamesession
     *
     * @param $currentTurn
     * @param $gameSessionId
     * @return int
     */
    function turnPosition($currentTurn, $gameSessionId)
    {


        //retrieving all gameturns corresponding to the game session
        $gameTurns = GameTurn::where('gamesessions_id', $gameSessionId)->get();

        //initializing loop counter
        $counter = 1;

        //looping through gameturns
        foreach ($gameTurns as $gameTurn) {

            //we are looking for the fist turn that is the same as the one in parameters.
            if ($gameTurn->id = $currentTurn->id) {

                //that's good so get out of this loop, NOW!
                break;
            } else {// Well.. let's see if the next one is the good one.

                $counter++;
            }

        }

        //return the loop counter value as turn position.
        return $counter;
    }


    function orderFileExists($orders)
    {
        $boolean = false;
        foreach ($orders as $order) {
            $file = Upload::where('category', 'turnorders')
                ->where('entity_id', $order->id)
                ->get();
            if (isset($file->filename)) {
                $boolean = true;
                break;
            }
        }
        return $boolean;
    }

    /**
     * @param $gameTurn
     * @param $player_mail
     * @param $player_name
     * @param $user_name
     * @param $user_email
     * @param $subject
     * @param $link
     * @return \stdClass
     */
    public function createEmail($gameTurn, $player_mail, $player_name, $user_name, $user_email, $subject, $link): \stdClass
    {
        $email = new \stdClass();
        $email->message = $gameTurn->description;
        $email->from = $player_mail;
        $email->recipient = $player_name;
        $email->sender = "$user_name : $user_email";
        $email->attachment = $user_email;
        $email->receiver = $player_name;
        $email->subject = $subject;
        $email->turn_title = $gameTurn->title;
        $email->link = $link;
        return $email;
    }

    /**
     * @param $email
     * @param $files
     */
    public function sendMail($email, $files): void
    {
        Mail::send('gamesessions.mails.notification', ['email' => $email], function ($m) use ($email, $files) {


            $m->from('le.pire.ottoman@gmail.com', config('name'));
            $m->to($email->from, $email->recipient)
                ->subject($email->subject);

            foreach ($files as $file) {
                $filename = $file->filename;
                $path = public_path('/images');
                $path_to_file = $path . "/" . $filename;
                $original_name = $filename = $file->original_name;
                $m->attach($path_to_file, ['as' => $original_name]);
            }


        });
    }

}


?>