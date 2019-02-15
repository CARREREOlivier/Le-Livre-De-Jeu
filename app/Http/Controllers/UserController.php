<?php 

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class UserController extends Controller 
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
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($username)
  {

     $user = User::where('username',$username)->first();
    // $user = $user->pluck("username", "email");


      return View('profile.show')->with('user', $user);
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


  public function sendResetLink()
  {
        $userId=Auth::user()->id;
        $user=User::find($userId);

        $credentials = ['email' => $user->email];
        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject("Lien pour mettre à jour votre mot de passe");
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                $backToPage = redirect()->back()->with('status', trans($response));
            case Password::INVALID_USER:
                $backToPage = redirect()->back()->withErrors(['email' => trans($response)]);
        }

        return $backToPage;
  }


}

?>