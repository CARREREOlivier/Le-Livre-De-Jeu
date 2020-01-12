<?php

namespace App\Http\Controllers;


use App\Factories\StoryPostFactory;
use App\Story;
use App\StoryComment;
use App\StoryPost;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $users = User::where('status', "User")->select('email', 'id', 'username')->get();

        list($arrayCoAuthors, $coAuthorsList) = $this->fetchCoAuthorsUserNames($story_post);

        /*
         * assigning true value to coauthors in users array
         */
        $users = $this->assignCheckedStatus($arrayCoAuthors, $users);

        /*
         * Permissions status
         */
        if (isset(Auth()->user()->id)) {
            $userId = Auth()->user()->id;

            $isAuthor = $this->isAuthor($userId, $story_post);
            $isCoAuthor = $this->isCoAuthor($userId, $story_post);
            $canRead = $this->canRead($userId, $story_post);
        } else {
            $userId = null;

            $isAuthor = false;
            $isCoAuthor = false;
            $canRead = false;
        }

        if ($story_post->visible_by === "all") {

            $allCanRead = true;

        } else {
            $allCanRead = false;}


        $array = ['text',
            'username',
            'stories_comments.created_at'];
        $story_comments = User::join('stories_comments', 'users.id', '=', 'stories_comments.user_id')->select($array)->get();

        /*
         * Send to view
         */

        return View('stories.main')
            ->with('story_post', $story_post)
            ->with('allPosts', $allPosts)
            ->with('previousPost', $previousPost)
            ->with('nextPost', $nextPost)
            ->with('author', $author)
            ->with('users', $users)
            ->with('co_authors', $coAuthorsList)
            ->with('isAuthor', $isAuthor)
            ->with('isCoAuthor', $isCoAuthor)
            ->with('canRead', $canRead)
            ->with('story_comments', $story_comments)
            ->with('allCanRead',$allCanRead);

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

        $users = User::where('status', 'User')->select('id', 'username', 'email')->get();//the owner of the post (author) is removed at a later stage in the view logic.
        $arrayCoAuthors = explode(";", $story_post->co_author, -1);
        /*
         * assigning true value to coauthors in users array
         */
        $users = self::assignCheckedStatus($arrayCoAuthors, $users);

        return View('stories.main')
            ->with('story_post', $story_post)
            ->with('users', $users);
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

        $storyPost = $this->updateStoryPost($request, $slug);

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

    public function updateCoAuthorsPost(Request $request, $slug)
    {
        $users = $request['checkBox'];
        $userList = null;
        foreach ($users as $user) {
            $userList .= $user . ";";

        }

        $story_post = StoryPost::where('slug', $slug)->firstOrFail();
        $story_post->co_author = $userList;
        $story_post->save();


        return back()->withInput();
    }

    public function updateVisibilityPost(Request $request, $slug)
    {
        $storyPost = StoryPost::where('slug', $slug)->firstOrFail();
        if ($request->get('toggleVisibility') === "all") {
            $storyPost->visible_by = "all";
            $storyPost->save();

            return back()->withInput();
        }

        if ($request->get('toggleVisibility') === null) {

            $users = $request['cbCanSee'];
            $userList = null;
            foreach ($users as $user) {
                $userList .= $user . ";";

            }
            $storyPost->visible_by = $userList;
            $storyPost->save();

        }
        return back()->withInput();
    }

    /**
     * for maintenance purpose as the block is used several times
     * @param $arrayCoAuthors
     * @param $users
     * @return mixed
     */
    function assignCheckedStatus($arrayCoAuthors, $users)
    {
        foreach ($arrayCoAuthors as $coAuthor) {
            foreach ($users as $user) {
                if ($user->id == $coAuthor) {
                    $user->checked = 'true';
                }
            }
        }

        return $users;

    }

    function isAuthor($userId, $story_post)
    {

        $boolean = false;

        if ($story_post->author === $userId) {
            $boolean = true;
        }


        return $boolean;
    }

    function isCoAuthor($userId, $story_post)
    {

        $boolean = false;
        $arrayCoAuthors = explode(';', $story_post->co_author, -1);

        foreach ($arrayCoAuthors as $coAuthor) {

            if ($userId === $coAuthor) {
                $boolean = true;
            }

        }


        return $boolean;
    }

    function canRead($userId, $story_post)
    {


        $boolean = false;

        if (isset($story_post->visible_by) === false) {
            $boolean = false;
        }

        if ($story_post->visible_by === "all") {
            $boolean = true;

        } elseif ($story_post->visible_by !== "all" && isset($story_post->visible_by) === true) {

            $arrayCanRead = explode(';', $story_post->visible_by, -1);

            foreach ($arrayCanRead as $reader) {
                if ($userId === $reader) {
                    $boolean = true;
                }

            }
        }


        return $boolean;

    }

    /**
     * @param $story_post
     * @return array
     */
    private function fetchCoAuthorsUserNames($story_post): array
    {
        $arrayCoAuthors = explode(";", $story_post->co_author, -1);

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

        }
        return array($arrayCoAuthors, $coAuthorsList);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    private function updateStoryPost(Request $request, $slug)
    {
        $storyPost = StoryPost::where('slug', $slug)->firstOrFail();
        $storyPost->title = $request->title;
        $storyPost->text = $request->text;
        $storyPost->slug = str_slug($request->title);
        $storyPost->save();
        return $storyPost;
    }


}


?>