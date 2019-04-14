<?php

namespace App\Http\Controllers;

use App\GameTurn;
use \App\TurnOrder;
use \App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Mockery\Exception;

class UploadController extends Controller
{

    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/images');
    }

    /**
     * Display all of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Upload::all();
        return view('fileupload.uploaded-images', compact('photos'));
    }

    /**
     * Show the form for creating uploading new images.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fileupload.upload');
    }

    /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        log::channel('single')->info('file is entering validation');
        //request validation


        try {
            $validator = Validator::make($request->allFiles(), [
                'filename.*' => 'file|required|max:4096|mimes:jpeg,jpg,bmp,png,tiff,txt,zip'
            ]);

            if ($validator->fails()) {
                log::channel('single')->error('file has failed validation'.$validator->errors());
                return redirect()->back()->with('errors', 'A-Taille de fichier maximum : 2Mo');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('errors', 'Le validateur de fichier a échoué avec succès');
        }
        log::channel('single')->info('file has past validation');
        //process
        $documents = $request->file('file');


        if (!is_array($documents)) {
            $documents = [$documents];

        }

        if (!is_dir(storage_path('app/public/uploads'))) {
            Storage::disk('public')->makeDirectory('/uploads');
        }

        for ($i = 0; $i < count($documents); $i++) {
            $document = $documents[$i];
            //checking extension
            log::channel('single')->info('file is entering entering extension validation');
            $extension = $document->getClientOriginalExtension();
            log::channel('single')->info('file extension is'.$extension);
            log::channel('single')->info('file name is'.$document);
            if (!in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff", "txt", "zip", "ord", "hst", "trn"))) {

                $message = 'un fichier contient une extension interdite et cela est interdit à l\'upload';
                return \redirect()->back()->with('message', $message);
            }

            log::channel('single')->warning('file as past validation');
            $name = $this->generateName();
            $save_name = $this->generateSaveName($name, $document);
            $resize_name = $this->generateResizeName($name, $document);

            $pathAndFileName = 'uploads/' . $save_name; // located in
            //Storing files to disk

            Storage::putFileAs('public', $document, $pathAndFileName);

            if (in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff"))) {
                $image = Image::make(Storage::disk('public')->get($pathAndFileName))->resize(125, null, function ($constraints) {
                    $constraints->aspectRatio();
                })->stream();
                Storage::disk('public')->put('uploads/' . $resize_name, $image);
            }

            //Doing copies as the symlink does not seems to work on ovh
            $storage_path = storage_path() . "/app/public";
            $public_path = public_path() . '/uploads';

            File::move("$storage_path/uploads/$save_name", "$public_path/$save_name");

            if (in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff"))) {
            File::move("$storage_path/uploads/$resize_name", "$public_path/$resize_name");
            }

            $upload = $this->buildUpload($document, $save_name, $resize_name);//TODO:should be receiving an array
            $upload->user_id = $request->user()->id;

            if (isset($request->category)) {
                $upload->category = $request->category;
            } else {
                $upload->category = 'uncategorized';
            }

            $upload->entity_id = $request->entity_id;
            $upload->save();

            Log::channel('single')->warning("upload saved in database under id : " . $upload->id);
            switch ($upload->category) {
                case 'gameturns':
                    Log::channel('single')->warning("gameturns :: nothing to do");
                    break;
                case 'turnorders':
                    Log::channel('single')->warning("turnorder :: rewriting turnorder :$upload->entity_id");
                    $this->rewriteTurnOrder($upload->entity_id, $upload->filename);
                    break;
                case 'story_post':

                    break;
                case 'info_post':

                    break;
                case 'uncategorized':

                    break;
                case 'tutorial_post':

                    break;
            }

        }
        return Response::json([
            'message' => 'Image saved Successfully'
        ], 200);

    }

    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $filename = $request->id;
        $uploaded_image = Upload::where('original_name', basename($filename))->first();

        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }

        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
        $resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        if (file_exists($resized_file)) {
            unlink($resized_file);
        }

        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }

        return Response::json(['message' => 'File successfully delete'], 200);
    }

    public function deleteFile($id)
    {
        $file = Upload::find($id);
        $filename = $file->filename;

        $uploaded_document = Upload::where('filename', basename($filename))->first();

        if (empty($uploaded_document)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }

        /*$file_path = $this->photos_path . $uploaded_image->filename;
        $resized_file = $this->photos_path . $uploaded_image->resized_name;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        if (file_exists($resized_file)) {
            unlink($resized_file);
        }*/

        if (!empty($uploaded_document)) {
            $uploaded_document->delete();
        }
        return Redirect::back();

        //return Response::json(['message' => 'File successfully deleted'], 200);
    }

    function rewriteGameTurn($gameTurnId, $filename)
    {

        $gameTurn = GameTurn::where('id', $gameTurnId)->firstOrFail();
        $file = Upload::where('filename', $filename)->firstOrFail();

        $description = $gameTurn->description;

        $downloadLink = "<a href=\"/storage/uploads/$filename\" download=\"$file->original_name\"><i class=\"fas fa-download\"></i>$file->original_name</a>";

        $gameTurn->description = $description . " " . $downloadLink;
        $gameTurn->save();

    }

    function rewriteTurnOrder($TurnOrderId, $filename)
    {

        $turnorder = TurnOrder::where('id', $TurnOrderId)->firstOrFail();//find() does not work. Don't know why.
        $file = Upload::where('filename', $filename)->firstOrFail();


        $message = $turnorder->message;

        //building download link
        $downloadLink = "<br/><a href=\"/uploads/$filename\" download=\"$file->original_name\"><i class=\"fas fa-download\"></i>$file->original_name</a>";

        //saving message with download link
        $turnorder->message = $message . " " . $downloadLink;

        //saving turn order.
        $turnorder->save();

    }

    public function storeViaTinyMCE(Request $request)
    {

        log::channel('single')->info('file is entering validation');
        //request validation
        try {
            $validator = Validator::make($request->allFiles(), [
                'filename.*' => 'file|required|max:2048|mimes:jpeg,jpg,bmp,png,tiff,txt,zip'
            ]);

            if ($validator->fails()) {
                log::channel('single')->error('file has failed validation'.$validator->errors());
                return redirect()->back()->with('errors', 'A-Taille de fichier maximum : 2Mo');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('errors', 'Le validateur de fichier a échoué avec succès');
        }
        log::channel('single')->info('file has past validation');

        //extractiong files from request
        $documents = $request->file('file');

        //Checking if directory exists
        if (!is_array($documents)) {
            $documents = [$documents];
        }
        //if not creating it
        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0755);
        }

        //looping though uploaded files
        for ($i = 0; $i < count($documents); $i++) {
            $document = $documents[$i];

            //checking extension of file
            log::channel('single')->info('file is entering entering extension validation');
            $extension = $document->getClientOriginalExtension();
            log::channel('single')->info('file extension is'.$extension);
            log::channel('single')->info('file name is'.$document);
            if (!in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff", "txt", "zip", "ord", "hst"))) {

                $message = 'un fichier contient une extension interdite et cela est interdit à l\'upload';
                return \redirect()->back()->with('message', $message);
            }

            //Naming elements to save;
            $name = $this->generateName();
            $save_name = $this->generateSaveName($name, $document);
            $resize_name = $this->generateResizeName($name, $document);

            $pathAndFileName = 'uploads/' . $save_name; // located in uploads folder

            //Storing file to disk
            Storage::putFileAs('public', $document, $pathAndFileName);

            //if file is picture then a resized image is generated has thumbnail. If not it has the not_image_icon attributed.
            if (in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff"))) {
                $image = Image::make(Storage::disk('public')->get($pathAndFileName))->resize(125, null, function ($constraints) {
                    $constraints->aspectRatio();
                })->stream();
                Storage::disk('public')->put('uploads/' . $resize_name, $image);
            } else {
                $resize_name = "not_image_icon.jpg";
            }

            //Doing copies as the symlink does not seems to work on ovh
            $storage_path = storage_path() . "/app/public";
            $public_path = public_path() . '/uploads';

            File::move("$storage_path/uploads/$save_name", "$public_path/$save_name");
            File::move("$storage_path/uploads/$resize_name", "$public_path/$resize_name");


            //Saving to database
            $upload = $this->buildUpload($document, $save_name, $resize_name);//TODO:should be receiving an array
            $upload->user_id = $request->user()->id;
            if (isset($request->category)) {
                $upload->category = $request->category;
            } else {
                $upload->category = 'uncategorized';
            }
            $upload->entity_id = $request->entity_id;
            $upload->save();


            switch ($upload->category) {
                case 'gameturns':
                    Log::channel('single')->warning("gameturns :: nothing to do");
                    break;
                case 'turnorders':
                    Log::channel('single')->warning("turnorders :: rewriting turn");
                    $this->rewriteTurnOrder($upload->entity_id, $upload->filename);
                    break;
                case 'story_post':

                    break;
                case 'info_post':

                    break;
                case 'uncategorized':

                    break;
                case 'tutorial_post':

                    break;
            }

        }
        return Response::json([
            'location' => "/uploads/$save_name",
            'link' => "/uploads/$save_name",
        ], 200);
    }


    function buildUpload($document, $save_name, $resized_name)
    {

        $upload = new Upload();
        $upload->filename = $save_name;
        $upload->resized_name = $resized_name;
        $upload->original_name = basename($document->getClientOriginalName());

        return $upload;

    }

    function generateName()
    {
        $name = sha1(date('YmdHis') . str_random(30));
        return $name;
    }

    function generateSaveName($name, $document)
    {
        $save_name = $name . '.' . $document->getClientOriginalExtension();
        return $save_name;
    }

    function generateResizeName($name, $document)
    {
        $resize_name = $name . str_random(2) . '.' . $document->getClientOriginalExtension();
        return $resize_name;
    }


    public function respudStore(Request $request)
    {

        //request validation

        try {
            $validator = Validator::make($request->all(), [
                'file' => 'file|required|max:2048|mimes:jpeg,jpg,bmp,png,tiff,txt,zip,ord,hst'
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
        } catch (Exception $e) {

            return redirect()->back()->with('message', 'Taille de fichier maximum : 2Mo');

        }

        $document = $request->file('file');

        $extension = $document->getClientOriginalExtension();
        if (!in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff", "txt", "zip", "ord", "hst"))) {

            $message = 'un fichier contient une extension interdite et cela est interdit à l\'upload';
            return \redirect()->back()->with('message', $message);
        }

        //if upload directory des not exist, create it.
        if (!is_dir(storage_path('app/public/uploads'))) {
            Storage::disk('public')->makeDirectory('/uploads');
        }

        //building names
        $name = $this->generateName();
        $save_name = $this->generateSaveName($name, $document);
        $resize_name = $this->generateResizeName($name, $document);

        $pathAndFileName = 'uploads/' . $save_name; // located in
        $extension = $document->getClientOriginalExtension();
        //Storing files to disk

        Storage::putFileAs('public', $document, $pathAndFileName);

        if (in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff"))) {

            $image = Image::make(Storage::disk('public')->get($pathAndFileName))->resize(125, null, function ($constraints) {
                $constraints->aspectRatio();
            })->stream();

            Storage::disk('public')->put('uploads/' . $resize_name, $image);
        }


        //Doing copies as the symlink does not seems to work on ovh
        $storage_path = storage_path() . "/app/public";
        $public_path = public_path() . '/uploads';

        File::move("$storage_path/uploads/$save_name", "$public_path/$save_name");
        if (in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff"))) {
            File::move("$storage_path/uploads/$resize_name", "$public_path/$resize_name");
        }
        //building upload
        $upload = new Upload();

        $upload->filename = $save_name;
        $upload->category = "gameturns";
        $upload->entity_id = $request->entity_id;
        $upload->user_id = $request->user_id;
        $upload->resized_name = $resize_name;
        $upload->original_name = basename($document->getClientOriginalName());

        //saving
        $upload->save();
        //

        return redirect()->back()->with('message', "fichier $upload->original_name traité!");

    }

}

?>