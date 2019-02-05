<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 04/02/2019
 * Time: 15:36
 */

namespace App\Factories;


use App\TurnOrder;

class TurnOrderFactory
{


    public static function build($gameTurnId, $userId)
    {

        $turnOrder = new TurnOrder();
        $turnOrder->gameturn_id = $gameTurnId;
        $turnOrder->user_id = $userId;
        $turnOrder->message = "" ;

        return $turnOrder;
    }

}