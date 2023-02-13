<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// use App\Http\Controllers\AdminUsersController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', function () {
        return view('admin.index');
    });
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/media', 'AdminMediasController');
    // Route::resource('admin/media/upload',['as'=>'admin.media.upload', 'users'=> 'AdminMediasController@store']);
    Route::resource('admin/comments', 'PostCommentsController');
    Route::resource('admin/comment/replies', 'CommentRepliesController');
});
Route::resource('admin/users', AdminUsersController::class);
Route::resource('admin/posts', AdminPostsController::class);
Route::resource('admin/categories', AdminCategoriesController::class);
Route::resource('admin/media', AdminMediasController::class);

Route::group(['middleware'=>'auth'], function(){
    Route::post('comment/reply', 'CommentRepliesController@createReply');
});
