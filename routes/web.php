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

Route::get('/','WelcomeController@show' )->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/github', function(){
    return redirect('https://github.com/Flefounet/Le-Livre-De-Jeu');
})->name('github');

Route::resource('user', 'UserController');
Route::resource('gamesession', 'GameSessionController', ['except' => [
    'show',
    'edit'
]]);
Route::get('gamesession/{slug}','GameSessionController@show')->name('gamesession.show');
Route::get('gamesession/edit-{slug}','GameSessionController@edit')->name('gamesession.edit');
Route::post('gameturn/lock-{id}', 'GameTurnController@lock')->name('gameturn.lock');
Route::get('gameturn/create-turn-for/{slug}', 'GameTurnController@create')->name('gameturn.create-turn');
Route::resource('gameturn', 'GameTurnController');
Route::resource('gamerole', 'GameRoleController');

Route::resource('storyrole', 'StoryRoleController');
Route::resource('gamesessioncomment', 'GameSessionCommentController');
Route::resource('storycomment', 'StoryCommentController');


/*NEWS*/
Route::get('info/create', 'InfoController@create')->name('info.create');
Route::get('info/{slug}', 'InfoController@show')->name('info.show');
Route::get('info/{slug}/edit', 'InfoController@edit')->name('info.edit');
Route::delete('info/delete-{slug}', 'InfoController@destroy')->name('info.destroy');

Route::resource('info', 'InfoController', ['except' => [
    'create',
    'show',
    'edit',
    'destroy'
]]);


Route::resource('infocomment', 'InfoCommentController');

Route::get('infopost/{slug}/create', 'InfoPostController@create')->name('news.add.post');


Route::resource('infopost', 'InfoPostController');
Route::resource('tutorial', 'TutorialController');
Route::resource('tutorialpost', 'TutorialPostController');
Route::resource('tutorialcomment', 'TutorialCommentController');
Route::resource('turnorder', 'TurnOrderController');


/*AARs*/
Route::resource('story', 'StoryController');
Route::resource('storypost', 'StoryPostController');
Route::get('story/{slug}', 'StoryController@show')->name('story.show');
Route::delete('story/delete/{slug}', 'StoryController@destroy')->name('story.delete');
Route::put('story/{slug}/update', 'StoryController@update')->name('story.update');
Route::get('story/{slug}/create_post', 'StoryPostController@create')->name('story.add.post');
route::post('story/store_post','StoryPostController@store')->name('story.store.post');

Route::get('story/post/{slug}', 'StoryPostController@show')->name('story.show.post');
Route::delete('story/post/delete/{slug}', 'StoryPostController@destroy')->name('story_post.delete');

/**
 * upload and download routes

Route::get('/files-create', 'UploadController@create');
Route::post('/files-save', 'UploadController@store');
Route::post('/files-saveTinyMCE', 'UploadController@storeViaTinyMCE');
Route::post('/files-delete', 'UploadController@destroy');//uses request to delete
Route::get('/delete-turn-file/{id}','UploadController@deleteFile')->name('upload.delete_file');// does not use request to delete
Route::get('/files-show', 'UploadController@index');
Route::get('/download/{file}', 'DownloadsController@download');
Route::get('/downloadZip/{id}', 'DownloadsController@zipMultipleFiles');

Route::post('/file-respud','UploadController@respudStore');


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


/*Profile page*/

Route::get('/profile/{username}', 'UserController@show')->name('profile');
Route::post('/profile-reset-p4$$w0rD', 'UserController@sendResetLink')->name('profile.reset.password');


/*Admin routes*/
Route::get('/admin', 'AdminController@index')->name('admin.main')->middleware('auth');
Route::put('/admin-update-user-{id}', 'AdminController@updateUser')->name('admin.update_user')->middleware('auth');

Route::get('/admin-update-gamesession-{id}', 'AdminController@editGameSession')->name('admin.update_gamesession')->middleware('auth');
Route::put('/admin-store-update-gamesession-{id}', 'AdminController@updateGameSession')->name('admin.store_update_gamesession')->middleware('auth');

Route::get('/admin-update-gameturn-{id}', 'AdminController@editGameTurn')->name('admin.update_gameturn')->middleware('auth');
Route::put('/admin-store-update-gameturn-{id}', 'AdminController@updateGameTurn')->name('admin.store_update_gameturn')->middleware('auth');

