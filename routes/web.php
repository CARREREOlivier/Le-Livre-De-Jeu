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
Route::resource('upload', 'UploadController');