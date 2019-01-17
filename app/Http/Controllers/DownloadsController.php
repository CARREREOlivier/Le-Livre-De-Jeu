<?php

namespace App\Http\Controllers;

use App\Upload;

class DownloadsController extends Controller
{
    public function download($filename)
    {

        $document = Upload::where('filename',$filename)->first();

        $file_path = public_path('images/' . $filename);
        $name =  $document->original_name;


        return response()->download($file_path, $name);

    }

}
