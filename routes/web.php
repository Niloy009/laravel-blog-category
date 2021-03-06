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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/categories/status/update/{category}', 'CategoryController@statusUpdate')->name('categories.status.update');
Route::resource('/categories','CategoryController');
Route::get('/posts/status/update/{post}', 'PostController@statusUpdate')->name('posts.status.update');
Route::resource('/posts','PostController');
Route::get('/forums/status/update/{forum}', 'ForumController@statusUpdate')->name('forums.status.update');
Route::resource('/forums','ForumController');
