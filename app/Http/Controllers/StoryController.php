<?php

namespace App\Http\Controllers;

use App\Factories\StoryFactory;
use App\Factories\StoryRoleFactory;
use App\Story;
use App\StoryPost;
use App\StoryRole;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        $this->addImgAutoResize($story);
        $story->save();

        return redirect()->route('story.index');

    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return mixed
     */
    public function show($slug)
    {
        $story = Story::where('slug', $slug)->firstOrFail();

        $posts = StoryPost::where('story_id', $story->id)->get();

        $author = User::find($story->user_id);
        $author = $author->username;

        list($editors, $authors, $currentUserRole) = $this->getRolesList($story);

        $this->fetchCoAuthorsNames($posts);//finds coauthors names and creates a new line into the object $posts that concatenates the

        $this->checkIfPostsAreVisibleForUser($posts, $story, $editors, $authors);

        return View('stories.main')
            ->with('story', $story)
            ->with('author', $author)
            ->with('posts', $posts)
            ->with('editors', $editors)
            ->with('authors', $authors)
            ->with('user_role', $currentUserRole);

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
     * @return Response
     */
    public function update(Request $request, $slug)
    {


        Log::channel('single')->info("Updating Story/AAR " . $slug);
        $story = Story::where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $story->title = $request->title;
        $story->description = $request->description;
        $this->addImgAutoResize($story);
        $story->slug = str_slug($request->title);
        $story->save();

        return redirect()->route('story.show', $story->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy($slug)
    {
        $story = Story::where('slug', $slug)->first();
        $story->delete();

        return redirect()->route('story.index');
    }


    public function editPermissions($slug)
    {

        $story = Story::where('slug', '=', $slug)->firstOrFail();
        $storyId = $story->id;

        $users = User::where('status', '<>', 'Admin')
            ->where('id', '<>', $story->user_id)
            ->select('id', 'username')
            ->get();

        $storyRoles = StoryRole::where('user_id', '<>', $story->user_id)
            ->with('getUserNames')
            ->where('story_id', '=', $storyId)
            ->get();


        $editors = $this->getRolesWithUserNames("Editor");
        $authors = $this->getRolesWithUserNames("Author");

        return View('stories.main')
            ->with('users', $users)
            ->with('storyRoles', $storyRoles)
            ->with('editors', $editors)
            ->with('authors', $authors)
            ->with('slug', $slug);
    }

    public function updatePermissions(Request $request, $slug)
    {
        $story = Story::where('slug', '=', $slug)->firstOrFail();

        $filtered = $this->removeToken($request);//CSRF token remove from request for the sake of clarity when processing the object. Token does not matter at this point unless I'm mistaken.

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
        array_shift($filtered);//token= ... removal of token
        return $filtered;
    }

    /**
     * @param $role
     * @return mixed
     */
    private function getRolesWithUserNames($role)
    {
        $storyUsers = StoryRole::where('role', '=', $role)->get();
        foreach ($storyUsers as $storyUser) {
            $storyUser->username = User::where('id', '=', $storyUser->user_id)->firstOrfail()->username;
        }
        return $storyUsers;
    }

    /**
     * @param $story
     * @param $editors
     * @param $authors
     * @return string|null
     */
    private function getCurrentUserRole($story, $editors, $authors)
    {
        $currentUserRole = null;

        if (Auth::guest()) {
            $currentUserRole = "guest";
        } else {
            if ($user = Auth::user()) {
                $currentUserRole = "reader";
            }
            if (Auth::user()->id === $story->user_id) {
                $currentUserRole = "owner";
            }
            if ($editors->contains(Auth::user()->id)) {
                $currentUserRole = "editor";
            }
            if ($authors->contains(Auth::user()->id)) {
                $currentUserRole = "author";
            }
            if (Auth::user()->status === 'Admin') {
                $currentUserRole = "Admin";
            }
        }
        return $currentUserRole;
    }

    /**
     * @param $story
     * @return array
     */
    private function getRolesList($story): array
    {
        $editors = $this->getRolesWithUserNames("Editor");
        $authors = $this->getRolesWithUserNames("Author");

        $currentUserRole = $this->getCurrentUserRole($story, $editors, $authors);
        return array($editors, $authors, $currentUserRole);
    }

    /**
     * @param $posts
     */
    private function fetchCoAuthorsNames($posts): void
    {
        foreach ($posts as $post) {
            $postAuthor = User::find($post->author);
            $post->authorName = $postAuthor->username;

            if ($post->co_author !== 'none') {

                $arr = explode(";", $post->co_author);

                $arr = array_filter($arr);
                $nbRows = count($arr);
                $rowNumber = 1;
                foreach ($arr as $row) {

                    $id = intval($row);
                    $person = User::find($id);
                    $username = $person['username'];
                    if ($rowNumber !== $nbRows) {
                        $post->co_authorsNames .= $username . ", ";
                    } else {
                        $post->co_authorsNames .= $username;
                    }
                    $rowNumber++;

                }

            }
        }
    }

    /**
     * @param $posts
     * @param $story
     * @param $storyEditors
     * @param $storyAuthors
     */
    private function checkIfPostsAreVisibleForUser($posts, $story, $storyEditors, $storyAuthors): void
    {


        foreach ($posts as $post) {
            $userCanSeePost = 0;
            if ($user = Auth::user()) {
                if (Auth::user()->status === "Admin") {
                    $userCanSeePost += 1;
                }

                if ($story->user_id === Auth::user()->id) {
                    $userCanSeePost += 1;

                }

                foreach ($storyEditors as $storyEditor) {
                    if ($storyEditor->user_id === Auth::user()->id) {
                        $userCanSeePost += 1;
                        break;
                    }
                }

                foreach ($storyAuthors as $storyAuthor) {
                    if ($storyAuthor->user_id === Auth::user()->id) {
                        $userCanSeePost += 1;
                        break;
                    }
                }


                if ($post->author === Auth::user()->id) {
                    $userCanSeePost += 1;
                }


                if ($post->co_author !== 'none') {
                    $arr = explode(";", $post->co_author);
                    if (in_array(Auth::user()->id, $arr)) {
                        $userCanSeePost += 1;
                    }
                }
            }

            if ($post->visible_by === "all") {
                $userCanSeePost += 1;
            }

            //dd($test);
            if ($userCanSeePost > 0) {
                $post->isVisible = true;
            } else {
                $post->isVisible = false;
            }


        }
    }

    private function addImgAutoResize(Story $story): void
    {
        $story->description = str_replace("<img alt=", "<img class=\"img-fluid auto-height\" alt=", "$story->description");
    }

}
