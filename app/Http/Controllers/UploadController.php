<?php

namespace App\Http\Controllers;

use App\GameTurn;
use \App\TurnOrder;
use \App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Mockery\Exception;
use App\Utils\DataFinder;

class UploadController extends Controller
{

    private $photos_path;

    public function __construct(DataFinder $dataFinder)
    {
        $this->photos_path = public_path('/images');
        $this->dataFinder = $dataFinder;
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
                log::channel('single')->error('file has failed validation' . $validator->errors());
                return redirect()->back()->with('errors', 'A-Taille de fichier maximum : 4Mo');
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
            log::channel('single')->info('file extension is' . $extension);
            log::channel('single')->info('file name is' . $document);
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
                    Log::channel('single')->warning("gameturns :: nothing to do!!!");

                    break;
                case 'turnorders':

                    Log::channel('single')->info("turnorder :: rewriting turnorder :$upload->entity_id");
                    $this->rewriteTurnOrder($upload->entity_id, $upload->filename);

                    $notificationStatus = $this->notifyGameMaster($upload->entity_id);
                    if ($notificationStatus < 3) {
                        Log::channel('single')->info("test");
                        //gamemaster
                        $turnOrder_id = intval($upload->entity_id);
                        $turnOrder = TurnOrder::where('id', $turnOrder_id)->firstOrFail();//find() does not work. Don't know why.
                        Log::channel('single')->info("finding turn order id: $upload->entity_id");

                        $turn_id = $turnOrder->gameturn_id;
                        Log::channel('single')->info("finding turn id: $upload->entity_id");

                        $gameTurn = GameTurn::find($turn_id);
                        $players = $this->dataFinder->getPeople('GameMaster', $gameTurn->gamesessions_id);
                        $player = $players->last();

                        //getting game Master mail and name
                        $player_name = $player->getusers->username;
                        $player_mail = $player->getusers->email;
                        Log::channel('single')->info("finding gamemaster :  $player_name");
                        $user_email = Auth::user()->email;
                        $user_name = Auth::user()->username;

                        //building subject

                        $subject = "fichier uploadé par $user_name";
                        $message = null;

                        //todo: create function buildMessage
                        if ($notificationStatus == 2) {
                            $message = "L'avant dernier joueur a uploadé son ordre";

                        }

                        if ($notificationStatus == 1) {
                            $message = "Le dernier joueur a uploadé son ordre. La résolution attend";

                        }
                        //instantiating mailable object
                        $email = $this->createEmail($gameTurn, $player_mail, $player_name, $user_name, $user_email, $subject, $message);
                        //sending notification to gamemaster to warn her/him he got a new file uploaded.
                        $this->sendMail($email);
                        //cleaning memory-php should do it anyway but who knows?
                        unset($email);
                    }
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
                'filename.*' => 'file|required|max:4096|mimes:jpeg,jpg,bmp,png,tiff,txt,zip'
            ]);

            if ($validator->fails()) {
                log::channel('single')->error('file has failed validation' . $validator->errors());
                return redirect()->back()->with('errors', 'A-Taille de fichier maximum : 4Mo');
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
            log::channel('single')->info('file extension is' . $extension);
            log::channel('single')->info('file name is' . $document);
            if (!in_array($extension, array("jpg", "jpeg", "gif", "bmp", "tiff", "txt", "zip", "ord", "hst", "trn"))) {

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

    /**
     * @param $email
     */
    public function sendMail($email): void
    {

        Log::channel('single')->info("sending mail from " . $email->from);
        Log::channel('single')->info("sending mail to " . $email->recipient);
        Log::channel('single')->info("subject " . $email->subject);
        Log::channel('single')->info("message " . $email->message);

        Mail::send('gameturns.mails.notification', ['email' => $email], function ($m) use ($email) {


            $m->from('lebossdulelivredejeu@gmail.com', 'Le livre De Jeu');
            $m->to($email->from, $email->recipient)
                ->subject($email->subject);

        });


    }

    /**
     * @param $gameTurn
     * @param $player_mail
     * @param $player_name
     * @param $user_name
     * @param $user_email
     * @param $subject
     * @param $message
     * @return \stdClass
     */
    public function createEmail($gameTurn, $player_mail, $player_name, $user_name, $user_email, $subject, $message): \stdClass
    {
        $email = new \stdClass();
        $email->message = $gameTurn->description;
        $email->from = $player_mail;
        $email->recipient = $player_name;
        $email->sender = "$user_name : $user_email";
        $email->receiver = $player_name;
        $email->subject = $subject;
        $email->message = $message;
        $email->turn_title = $gameTurn->title;
        return $email;
    }


    /**
     * Gamemaster will be notified only if there is one player left to play his/her turn.
     * Thi method return a boolean that will be used to trigger the email's expedition.
     * @param $turnOrderId
     * @return int|null
     */
    public function notifyGameMaster($turnOrderId)
    {
        Log::channel('single')->info("notification status is begining to be computed");
        $turn_id = $turnOrderId;
        Log::channel('single')->info("turn id: $turn_id");
        $turnOrder = TurnOrder::find($turn_id);
        $gameTurn_id = $turnOrder->gameturn_id;
        Log::channel('single')->info("game turn id: $gameTurn_id");
        $gameTurn = GameTurn::find($gameTurn_id);
        Log::channel('single')->info("recovered turn: $gameTurn->title");
        $notificationStatus = null;
        $hasUploaded = [];


        //players list recovery
        $players = $this->dataFinder->getPeople('GameParticipant', $gameTurn->gamesessions_id);
        Log::channel('single')->info("player list recovered : $players");
        //uploads recovery
        $uploads = Upload::where('entity_id', $turnOrderId)->get();

        Log::channel('single')->info("uploads recovered : $uploads");
        //check if players has uploaded something.
        //loop foreach through players'list
        foreach ($players as $player) {

            //loop foreach upload
            foreach ($uploads as $upload) {
                //is player's id in the upload list?
                if ($upload->user_id == $player->user_id) {
                    //if yes then push user_id to array
                    array_push($hasUploaded, $player->id);
                    break;
                }
            }//end loopforeach uploads
        } //end loop foreach players


        //count total numer of players
        $nbPlayers = count($players);

        Log::channel('single')->info("number of players : $nbPlayers");
        //count number of players that has uploaded something
        $nbUploadMade = count($hasUploaded);
        Log::channel('single')->info("number of uploadsmade : $nbUploadMade");
        //if difference between players and players who has uploaded something is equal or inferior to one, just make boolean true


            $notificationStatus = $nbPlayers - $nbUploadMade;


        Log::channel('single')->info("notification status : " . $notificationStatus);
        return $notificationStatus;
    }
}

?>