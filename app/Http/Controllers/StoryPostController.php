<?php

namespace App\Http\Controllers;


use App\Factories\StoryPostFactory;
use App\Story;
use App\StoryPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoryPostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();

        error_log($story->id);
        return View('stories.main')
            ->with('story_id', $story->id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $storyPost = StoryPostFactory::build($request);
        $storyPost->save();

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

        $story_post = StoryPost::where('slug', $slug)->firstOrFail();

        $allPosts = StoryPost::where('story_id', $story_post->story_id)->get();

        $currentPostId = $story_post->id;

        $previousPost = StoryPost::find($currentPostId - 1);
        $nextPost = StoryPost::find($currentPostId + 1);

        $author = User::find($story_post->author)->firstOrFail()->username;

        return View('stories.main')
            ->with('story_post', $story_post)
            ->with('allPosts', $allPosts)
            ->with('previousPost',$previousPost)
            ->with('nextPost',$nextPost)
            ->with('author',$author);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($slug)
    {
        $story_post = StoryPost::where('slug', $slug)->firstOrFail();

        return View('stories.main')
            ->with('story_post',$story_post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $slug)
    {

        Log::channel('single')->info("Updating AAR Post " . $slug);

        $storyPost = StoryPost::where('slug', $slug)->firstOrFail();
        error_log("storu post $storyPost->text");
        $storyPost->title = $request->title;
        $storyPost->text = $request->text;
        $storyPost->slug = str_slug($request->title);
        $storyPost->save();

        return redirect()->route('story.show.post', $storyPost->slug);

}

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($slug)
    {
        $story_post = StoryPost::where('slug', $slug)->firstOrFail();
        $story_post->delete();

        return redirect()->route('story.index');

    }

}

?>