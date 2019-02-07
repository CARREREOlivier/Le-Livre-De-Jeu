<?php

namespace App\Http\Controllers;

use App\Factories\GameTurnFactory;
use App\Factories\TurnOrderFactory;
use App\GameSession;
use App\GameTurn;
use App\TurnOrder;
use App\Upload;
use App\User;
use App\Utils\DataFinder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameTurnController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     * @param $id
     * @return $this
     */

    public function create($slug)
    {


        $gameSession=GameSession::where('slug',$slug)->firstOrFail();

        return View("gameturns.gameTurnNew")->with('gameSessionId', $gameSession->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {


        //validation
        $validatedData = Validator::make($request->all(), [
            'title' => 'required|max:126',
            'description' => 'max:1024',
            'long_description' => 'max:16000'
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()
                ->withErrors($validatedData)
                ->withInput();
        }


        //game turn creation
        $gameTurn = GameTurnFactory::build($request);

        $gameTurn->save();
        $gameSessionId = $gameTurn->gamesessions_id;

        $slug = $this->dataFinder->getGameSession('slug', $gameSessionId);

        //creating blank orders.
        $gameMaster = $this->dataFinder->getPeople('GameMaster', $gameSessionId);
        $turnOrder = TurnOrderFactory::build($gameTurn->id, $gameMaster->first()->user_id);

        $turnOrder->save();
        $players = $this->dataFinder->getPeople('GameParticipant', $gameSessionId);
        foreach ($players as $player) {
            $turnOrder = TurnOrderFactory::build($gameTurn->id, $player->user_id);
            $turnOrder->save();
        }

        //redirecting to current view for user
        return redirect()->route('gamesession.show', ['slug' => $slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

        $gameTurn = GameTurn::find($id);
        $gameSession = GameSession::find($gameTurn->gamesessions_id);

        $gamemaster = User::find($gameTurn->user_id);

        $gamemaster_files = Upload::where('category', '=', 'gameturns')
            ->where('entity_id', '=', $gameTurn->id)
            ->get();
        if ($gamemaster_files->count() < 1) {
            $gamemaster_files = null;
        }


        $orders = GameTurn::where('gamesessions_id', $gameSession->id)
            ->join('turnorders', 'turnorders.gameturn_id', '=', 'gameturns.id')
            ->join('users', 'turnorders.user_id', '=', 'users.id')
            ->select('gameturns.*', 'users.*', 'turnorders.*', 'turnorders.created_at as orderDate')
            ->get()
            ->makeHidden(['email', "email_verified_at", "password", "remember_token"]);

        if ($orders->count() == 0) {
            $orders = null;
        }

        return view("gameturns.gameTurnShow")
            ->with('gameTurn', $gameTurn)
            ->with('gamemaster_files', $gamemaster_files)
            ->with('orders', $orders)
            ->with('gameSession', $gameSession)
            ->with('gamemaster', $gamemaster);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

        $gameTurn = GameTurn::findOrFail($id);


        return View('gameturns.gameTurnsEdit')
            ->with('gameTurn', $gameTurn);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $gameTurn = GameTurn::findOrFail($id);

        $gameTurn->title = $request->title;
        $gameTurn->description = $request->description;
        $gameTurn->long_description = $request->long_description;

        $gameTurn->save();

        return $this->show($gameTurn->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $gameTurn = GameTurn::findOrFail($id);
        $gameSession = GameSession::findOrFail($gameTurn->gamesessions_id);

        $gameTurn->delete();

        return redirect()->route('gamesession.show',$gameSession->slug);

    }

    public function lock($id)
    {


        $gameTurn = GameTurn::findOrFail($id);
        if ($gameTurn->locked == false) {
            $gameTurn->locked = true;

        } else {
            $gameTurn->locked = false;
        }
        $gameTurn->save();

        return redirect()->back();

    }


}

?>