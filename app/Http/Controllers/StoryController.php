<?php

namespace App\Http\Controllers;

use App\Factories\StoryFactory;
use App\GameSession;
use App\Story;
use App\StoryPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function edit($slug)
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
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $slug)
    {

        Log::channel('single')->info("Updating Story/AAR " . $slug);


        $story = Story::where('slug', $slug)->firstOrFail();
        $story->title = $request->title;
        $story->description = $request->description;
        $story->slug = str_slug($request->title);
        $story->save();

        Log::channel('single')->info("plop");
        return redirect()->route('story.show', $story->slug);

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