<?php


namespace App\Factories;


use App\StoryRole;
use Illuminate\Http\Request;

class StoryRoleFactory
{
    public static function build($userId,$role,$story_id){

        $storyRole = new StoryRole();

        $storyRole->user_id = $userId;
        $storyRole->story_id = $story_id;
        $storyRole->role = $role;


        return $storyRole;

    }
}