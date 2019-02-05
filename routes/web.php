<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('user', 'UserController');
Route::resource('gamesession', 'GameSessionController');
Route::post('gameturn/lock-{id}', 'GameTurnController@lock')->name('gameturn.lock');
Route::resource('gameturn', 'GameTurnController');
Route::resource('gamerole', 'GameRoleController');
Route::resource('story', 'StoryController');
Route::resource('storyrole', 'StoryRoleController');
Route::resource('gamesessioncomment', 'GameSessionCommentController');
Route::resource('storycomment', 'StoryCommentController');
Route::resource('info', 'InfoController');
Route::resource('infocomment', 'InfoCommentController');
Route::resource('storypost', 'StoryPostController');
Route::resource('infopost', 'InfoPostController');
Route::resource('tutorial', 'TutorialController');
Route::resource('tutorialpost', 'TutorialPostController');
Route::resource('tutorialcomment', 'TutorialCommentController');
Route::resource('turnorder', 'TurnOrderController');


/**
 * upload and download routes
 *
 **/

Route::get('/files-create', 'UploadController@create');
Route::post('/files-save', 'UploadController@store');
Route::post('/files-saveTinyMCE', 'UploadController@storeViaTinyMCE');
Route::post('/files-delete', 'UploadController@destroy');//uses request to delete
Route::get('/delete-turn-file/{id}','UploadController@deleteFile')->name('upload.delete_file');// does not use request to delete
Route::get('/files-show', 'UploadController@index');
Route::get('/download/{file}', 'DownloadsController@download');
Route::get('/downloadZip/{id}', 'DownloadsController@zipMultipleFiles');


/**test view for dump**/

Route::get('/gamesession/gsni/{slug}', 'GameSessionController@show2')->name('gamesession.show2');

/*emails*/

Route::get('/contact', 'ContactController@show')
    ->middleware('auth')
    ->name('contact');
Route::post('/contact-mail',  'ContactController@mailToAdmin')
    ->name('contact-mail')
    ->middleware('auth');

route::get('/gamesession-send-notification-{id}', 'GameSessionController@mailToPlayers')
    ->name('gamesession.sendnotification')
    ->middleware('auth');