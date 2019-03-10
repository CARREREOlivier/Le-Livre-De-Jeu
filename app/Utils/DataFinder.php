<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 02/02/2019
 * Time: 09:38
 */

namespace App\Utils;


use App\GameRole;
use App\GameSession;

class DataFinder
{


    //GameSession getters
    public function getGameSession($field, $data)
    {

        if ($field == "slug") {

            $gameSessionId = $data;
            $gameSession = GameSession::find($gameSessionId);
            $slug = $gameSession->slug;

            return  $slug;

        } else {

            return null;
        }
    }


    //GameRole Getters
    public function getPeople($role, $gameSessionId){

        if ($role=='GameParticipant'){

            $people = GameRole::with('getUsers:id,username')
                ->where("gamesession_id", "=", $gameSessionId)
                ->where('gamerole', '=', 'GameParticipant')
                ->get();
        }
        if ($role=='GameMaster'){

            $people = GameRole::with('getUsers:id,username')
                ->where("gamesession_id", "=", $gameSessionId)
                ->where('gamerole', '=', 'GameMaster')
                ->get();
        }

        return $people;

    }



}
