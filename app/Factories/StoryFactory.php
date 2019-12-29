<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 07/04/2019
 * Time: 14:38
 */

namespace App\Factories;


use App\Story;
use Illuminate\Http\Request;


class StoryFactory
{

    public static function build(Request $request){

        $story = new Story();

        $story->user_id =$request->user()->id;
        $story->title = $request->title;
        $story->description = $request->description;
        $story->slug = str_slug($request->title);

        return $story ;

    }

}