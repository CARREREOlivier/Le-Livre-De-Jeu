<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 02/01/2019
 * Time: 17:52
 */

namespace App\Factories;


use App\GameTurn;
use Illuminate\Http\Request;


class GameTurnFactory
{
    public static function build(Request $request)
    {

        $gameTurn = new GameTurn();

        $gameTurn->user_id = $request->user()->id;
        $gameTurn->gamesessions_id = $request->gamesessions_id;
        $gameTurn->title = $request->title;
        $gameTurn->description = $request->description;
        $gameTurn->long_description = $request->long_description;

        return $gameTurn;
    }
}

