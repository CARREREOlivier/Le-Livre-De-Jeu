<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * With message configured reltively to current time
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $greetings = "";

        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");


        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            $greetings = "Bonjour";
        } else

            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                $greetings = "Bonne après-midi";
            } else

                /* Should the time be between or equal to 1700 and 1900 hours, show good day */
                if ($time >= "17" && $time < "19") {
                    $greetings = "Bonjour";
                } else
                    /* Should the time be between or equal to 1900 and 2200 hours, show good evening*/
                    if ($time >= "19" && $time < "22") {
                        $greetings = "Bonsoir";
                    } else

                        /* Finally, show good night if the time is greater than or equal to 1900 hours */
                        if ($time >= "22") {
                            $greetings = "Bonne nuit";
                        }

        return view('home')->with('greetings', $greetings);
    }
}
