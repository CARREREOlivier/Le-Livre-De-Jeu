<?php

namespace App\Http\Controllers;

use App\Info;
use App\InfoPost;
use Illuminate\Http\Request;

class InfoPostController extends Controller
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

        $news = Info::where('slug', $slug)->firstOrFail();
        return View('news.main')->with('info_id', $news->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        // request validation

        $post = new InfoPost();

        $post->user_id = $request->user()->id;
        $post->info_id = $request->info_id;
        $post->text = $request->text;

        $post->save();

        //reditect to index!
        return redirect()->route('info.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $post = InfoPost::find($id);
        return View('news.main')->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $post = $post = InfoPost::find($id);

        $post->text = $request->text;
        $post->save();

        $news = Info::find($post->info_id);
        return redirect()->route('info.show',$news->slug);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = InfoPost::find($id);
        $post->delete();
        return redirect()->back();
    }

}

?>