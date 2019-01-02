<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 02/01/2019
 * Time: 09:18
 */

namespace App\Factories;


use App\GameRole;

class GameRoleFactory
{

    public static function build($userId, $gameSessionId,$role)
    {

        $gameRole = new GameRole();

        $gameRole->user_id =$userId;
        $gameRole->gamesession_id = $gameSessionId;
        $gameRole->gamerole = $role;

        return $gameRole;
    }

}