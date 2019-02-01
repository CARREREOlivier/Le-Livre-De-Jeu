<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactEmail;
use App\Notifications\InboxMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.contact');
    }

    public function mailToAdmin(Request $request)
    {        //send the admin an notification
        //$admin->notify(new InboxMessage($message));
        // redirect the user back

        $validatedData = $request->validate([   'title' => 'bail|required|max:50',
            'message' => 'required|max:5000',
        ]);


        $user_email = Auth::user()->email;
        $user_name = Auth::user()->name;
      //  ContactFormRequest $message, Admin $admin
        $admin_mail = config('admin.email');
        $email = new \stdClass();
        $email->message = $request->message;
        $email->sender =  "$user_name : $user_email";
        $email->cc = $user_email;
        $email->receiver = 'Admin';
        $email->subject = $request->title;

        Mail::to( $admin_mail)->send(new ContactEmail( $email));
        return redirect()->back()->with('message', "Votre message a été envoyé et une copie vous à été envoyée sur $user_email
        . Je reviens vers vous très vite! ");
    }


}
