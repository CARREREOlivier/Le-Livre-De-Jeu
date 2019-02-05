<?php

namespace App\Http\Controllers;

use App\Factories\GameTurnFactory;
use App\Factories\TurnOrderFactory;
use App\GameSession;
use App\GameTurn;
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
     *
     * @return Response
     */
    public function create()
    {

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

        //creating blanck orders.
        $gameMaster = $this->dataFinder->getPeople('GameMaster', $gameSessionId);
        error_log("banzai 1");
        $turnOrder = TurnOrderFactory::build($gameTurn->id, $gameMaster->first()->user_id);

        error_log("gamemaster_id : $gameMaster");
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

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


        $gameTurn->save();

        return redirect()->back();

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
        // $gameSession = GameSession::findOrFail($gameTurn->gamesessions_id);

        $gameTurn->delete();

        return redirect()->back();

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