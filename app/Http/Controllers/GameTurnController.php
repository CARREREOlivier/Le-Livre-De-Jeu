<?php

namespace App\Http\Controllers;

use App\Factories\GameTurnFactory;
use App\GameSession;
use App\GameTurn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameTurnController extends Controller
{

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
        $validatedData=Validator::make($request->all(),[
            'title' => 'required|unique:gameturns|max:126',
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

        //redirecting to current view for user
        return redirect()->back();
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
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $gameTurn=GameTurn::findOrFail($id);
       // $gameSession = GameSession::findOrFail($gameTurn->gamesessions_id);

        $gameTurn->delete();

        return redirect()->back();

    }

}

?>