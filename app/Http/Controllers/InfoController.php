<?php

namespace App\Http\Controllers;

use App\Factories\NewsFactory;
use App\Info;
use App\InfoComment;
use App\InfoPost;
use App\User;
use Illuminate\Http\Request;

class InfoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $news = Info::all();

        return View('news.main')
            ->with('news', $news);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View('news.main');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //request validator

        //checking if user is really admin

        //building object!

        $news = NewsFactory::build($request);

        //saving to database
        $news->save();

        //reditect to index!
        return redirect()->route('info.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($slug)
    {
        $news = Info::where('slug', $slug)->firstOrFail();
        //$posts = InfoPost::where('info_id', $news->id)->get();

        $results= InfoPost::with(['getComments'])->where('info_id',$news->id);
        $posts = $results->get();

        $author = User::find($news->user_id);
        $author = $author->username;


        return View('news.main')
            ->with('news', $news)
            ->with('posts', $posts)
            ->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($slug)
    {

        $news = Info::where('slug', $slug)->firstOrFail();


        return View('news.main')->with('news', $news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $newsId)
    {
        $news = Info::find($newsId);
        $news->title = $request->title;
        $news->summary = $request->summary;
        $news->save();

        return redirect()->route('info.show', $news->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($slug)
    {
        error_log("i'm in");
        $news = Info::where('slug', $slug)->firstOrFail();
        $news->delete();
        error_log("i'm done");
        return redirect()->route('info.index');

    }


}

?>