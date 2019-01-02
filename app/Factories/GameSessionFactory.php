<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 02/01/2019
 * Time: 17:52
 */

namespace App\Factories;


use App\GameSession;

class GameSessionFactory
{
    public static function build($request)
    {

        $gameSession = new GameSession();

        $gameSession->user_id = $request->user()->id;;
        $gameSession->title = $request->title;
        $gameSession->game = $request->game;
        $gameSession->description = $request->description;
        $gameSession->slug = str_slug($gameSession->title);

        return $gameSession;
    }
}