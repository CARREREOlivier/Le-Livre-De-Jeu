<?php

namespace App\Http\Controllers;

use App\Factories\StoryFactory;
use App\GameSession;
use App\Story;
use App\StoryPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        //getting all story posts with author name fetched from user table
        $storyPosts = $this->getStoryPosts();

        //fetching Coauthors usernames in database
        $this->fetchCoAuthors($storyPosts);

        return View('stories.main')
            ->with('stories', $stories)
            ->with('storyPosts', $storyPosts);
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

        $posts = StoryPost::where('story_id', $story->id)->get();

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

    /**
     * @param \Illuminate\Support\Collection $storyPosts
     */
    private function fetchCoAuthors(\Illuminate\Support\Collection $storyPosts): void
    {
        foreach ($storyPosts as $storyPost) {

            $arrayCoAuthors = explode(";", $storyPost->co_author, -1);

            /*
             * creating the string to be displayed in the coauthor div in the view
             */
            $coAuthorsList = null;

            $counter = 1; //used to detect last iteration

            foreach ($arrayCoAuthors as $coAuthor) {
                $p = User::find($coAuthor);
                error_log($counter);
                if ($counter <> count($arrayCoAuthors)) {
                    $coAuthorsList .= $p->username . "-";
                }
                if ($counter === count($arrayCoAuthors)) {
                    $coAuthorsList .= $p->username;

                }
                $counter += 1;
                $storyPost->co_author = $coAuthorsList;
            }

        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getStoryPosts(): \Illuminate\Support\Collection
    {
        $storyPosts = DB::table('users')
            ->join('story_posts', 'story_posts.author', '=', 'users.id')
            ->select('users.id', 'users.username', 'users.status', 'story_posts.id', 'story_posts.created_at',
                'story_posts.story_id', 'story_posts.title', 'story_posts.author', 'story_posts.co_author', 'story_posts.visible_by', 'story_posts.slug')
            ->get();
        return $storyPosts;
    }

}

?>