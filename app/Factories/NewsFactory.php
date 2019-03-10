<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 24/02/2019
 * Time: 16:31
 */

namespace App\Factories;


use App\Info;

class NewsFactory
{

    public static function build($request){

        $news = new Info();

        $news->user_id = $request->user()->id;
        $news->title = $request->title;
        $news->summary = $request->summary;
        $news->slug = str_slug($request->title);

        return $news;

    }


}