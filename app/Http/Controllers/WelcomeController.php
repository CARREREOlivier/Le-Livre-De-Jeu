<?php

namespace App\Http\Controllers;

use App\GameSession;
use App\GameTurn;
use App\Info;
use App\Story;
use App\Tutorial;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function show()
    {

        //fetching last active gamesession with last turn
        $lastTurn = GameTurn::all()->last();
        $gameSession = GameSession::find($lastTurn->gamesessions_id);

        //fetching stories(AARs), tutorial and news
        $story = Story::all()->last();
        $tutorial = Tutorial::all()->last();
        $news = Info::all()->last();


        return view('welcome')
            ->with('gameSession', $gameSession)
            ->with('lastTurn', $lastTurn)
            ->with('news', $news)
            ->with('tutorial', $tutorial)
            ->with('story', $story);

    }
}
