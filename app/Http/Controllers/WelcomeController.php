<?php

namespace App\Http\Controllers;

use App\GameSession;
use App\GameTurn;
use App\Info;
use App\Story;
use App\Tutorial;
use Illuminate\Http\Request;
use stdClass;

class WelcomeController extends Controller
{
    public function show()
    {

        //fetching stories(AARs), tutorial and news
        $story = Story::all()->last();
        $tutorial = Tutorial::all()->last();
        $news = Info::all()->last();

        //fetching last active gamesession with last turn
        $lastTurn = GameTurn::all()->last();


        if(is_null($lastTurn)){

            $lastTurn = new stdClass();
            $lastTurn->title = "";
            $lastTurn->created_at = "";
            $lastTurn->description = "";
            $gameSession = new GameSession();
            $gameSession->title = "Créez une session de jeu!";

        }else{
            $gameSession = GameSession::find($lastTurn->gamesessions_id);
        }



        return view('welcome')
            ->with('gameSession', $gameSession)
            ->with('lastTurn', $lastTurn)
            ->with('news', $news)
            ->with('tutorial', $tutorial)
            ->with('story', $story);

    }
}
