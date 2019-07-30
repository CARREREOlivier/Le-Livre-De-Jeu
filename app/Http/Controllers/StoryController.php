<?php

namespace App\Http\Controllers;

use App\Factories\StoryFactory;
use App\Story;
use App\StoryPost;
use App\User;
use Illuminate\Http\Request;

class StoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $stories = Story::all();

        return View('stories.main')
            ->with('stories', $stories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View('stories.main');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //validator

        // storage

        $story = StoryFactory::build($request);
        $story->save();

        return redirect()->route('story.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();

        $results = StoryPost::with(['getComments'])->where('story_id', $story->id);
        $posts = $results->get();

        $author = User::find($story->user_id);
        $author = $author->username;

        return View('stories.main')
            ->with('story', $story)
            ->with('author', $author)
            ->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($slug)
    {
        $story = Story::where('slug', $slug)->first();
        $story->delete();

        return redirect()->route('story.index');
    }

}

?>