<?php

namespace App\Http\Controllers;

use \App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];

        }

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = sha1(date('YmdHis') . str_random(30));
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            $resize_name = $name . str_random(2) . '.' . $photo->getClientOriginalExtension();

            $extension = $photo->getClientOriginalExtension();
            $allowedImagesFormat = array('jpeg','jpg', 'gif', 'png', 'bmp');

            if (in_array($extension, $allowedImagesFormat)){
                Image::make($photo)
                    ->resize(48, null, function ($constraints) {
                        $constraints->aspectRatio();
                    })
                    ->save($this->photos_path . '/' . $resize_name);
            }
            $photo->move($this->photos_path, $save_name);

            $upload = new Upload();
            $upload->filename = $save_name;
            $upload->resized_name = $resize_name;
            $upload->original_name = basename($photo->getClientOriginalName());
            $upload->user_id = $request->user()->id;
            $upload->category = $request->category;
            $upload->entity_id = $request->entity_id;

            $upload->save();

            switch ($upload->category) {
                case 'gameturns':
                    error_log("gameturns user_id:" . $request->user()->id);
                    break;
                case 'story_post':
                    error_log("story_post user_id: $request->user_id ");
                    break;
                case 'info_post':
                    error_log("info_post user_id: $request->user_id ");
                    break;
                case 'uncategorized':
                    error_log("uncategorized user_id: $request->user_id ");
                    break;
                case 'tutorial_post':
                    error_log("uncategorized user_id: $request->user_id ");
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
}

?>