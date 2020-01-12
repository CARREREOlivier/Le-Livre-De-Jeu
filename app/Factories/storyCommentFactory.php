<?php


namespace App\Factories;


use App\StoryComment;
use Illuminate\Http\Request;

class storyCommentFactory
{
    public static function build(Request $request){

        $storyComment = new StoryComment();

        $storyComment->user_id = $request->user()->id;
        $storyComment->story_post_id =$request->story_post_id;
        $storyComment->text = $request->text;

        return $storyComment ;

    }
}