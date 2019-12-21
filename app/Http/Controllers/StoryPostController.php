<?php 

namespace App\Http\Controllers;

use App\Factories\StoryFactory;
use App\Factories\StoryPostFactory;
use App\Story;
use http\Client\Curl\User;
use Illuminate\Http\Request;

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
          ->with('story_id',$story->id);

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
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>