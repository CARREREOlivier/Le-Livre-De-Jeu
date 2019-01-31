<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\ContactFormRequest;
use App\Notifications\InboxMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.contact');
    }

    public function mailToAdmin(ContactFormRequest $message, Admin $admin)
    {        //send the admin an notification
        $admin->notify(new InboxMessage($message));
        // redirect the user back
        return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');
    }
}
