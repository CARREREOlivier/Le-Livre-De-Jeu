<?php

namespace App\Http\Controllers;

use App\Factories\StoryFactory;
use App\Factories\StoryRoleFactory;
use App\GameSession;
use App\Story;
use App\StoryPost;
use App\StoryRole;
use App\User;
use App\Utils\DataFinder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $fields = ['users.username',
            'stories.*'];

        $stories = DB::table('users')
            ->join('stories', 'stories.user_id', '=', 'users.id', "inner")
            ->select($fields)
            ->get();


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

    public function editPermissions($slug)
    {

        $story = Story::where('slug', '=', $slug)->firstOrFail();
        $storyId = $story->id;

        $users = User::where('status', '<>', 'Admin')->get();
        $storyRoles = StoryRole::with('getUserNames')->where('story_id', '=', $storyId)->get();

        return View('stories.main')
            ->with('users', $users)
            ->with('storyRoles', $storyRoles)
            ->with('slug', $slug);
    }

    public function updatePermissions(Request $request, $slug)
    {
        $story = Story::where('slug', '=', $slug)->firstOrFail();

       // $storyRoles = StoryRole::where('story_id', '=', $story->id)->get();

        $filtered = $this->removeToken($request);

        foreach ($filtered as $key => $value) {
            $userId = $this->remove_string('entry_', $key);
            if ($value === 'None') {
                StoryRole::where('story_id', '=', $story->id)
                    ->where('user_id', '=', $userId)->delete();
            }
            if ($value !== 'None') {
                try {

                    $storyRole = StoryRole::where('user_id', '=', $userId)->firstOrFail();

                    if ($storyRole->role !== $value) {

                        $storyRole->role = $value;
                        $storyRole->save();

                    }
                } catch (ModelNotFoundException $e) {


                    $storyRole = StoryRoleFactory::build($userId, $value, $story->id);
                    $storyRole->save();
                }

            }

        }

        return back()->withInput();

    }


    function object_to_array($data)
    {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = object_to_array($value);
            }
            return $result;
        }
        return $data;
    }

    function remove_string($stringToRemove, $stringToCleanse)
    {


        $str = preg_replace('/^' . $stringToRemove . '/', '', $stringToCleanse);


        return $str;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function removeToken(Request $request): array
    {
        $filtered = $request->toArray();
        $token = array_shift($filtered);
        return $filtered;
    }

}

?>