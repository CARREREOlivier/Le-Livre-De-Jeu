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
use Illuminate\Support\Facades\DB;

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


    public static function getEnumValues($table, $column) {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum = array_add($enum, $v, $v);
        }
        return $enum;
    }



}
