<?php


namespace App\Factories;


use App\Story;
use App\StoryPost;
use Illuminate\Http\Request;


class StoryPostFactory
{

    public static function build(Request $request){

        $storyPost = new StoryPost();

        $storyPost->user_id =$request->user()->id;
        $storyPost->story_id = $request->story_id;
        $storyPost->author = $request->user()->id; //author can be changed through another functionality. But at creation, current user is the author
        $storyPost->co_author = $request->co_author;
        $storyPost->visible_by = $request->visible_by;
        $storyPost->title = $request->title;
        $storyPost->text = $request->text;
        $storyPost->slug = str_slug($request->title);

        return $storyPost ;

    }

}

