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
    return redirect('/articles');
});
Route::get('/home', function () {
    return redirect('/articles');
});

Auth::routes();

Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::resource('articles', 'ArticleController')->middleware('auth');
Route::post('/comments/{article}', 'CommentController@store')->name('comments.storeComment')->middleware('auth');
Route::resource('comments', 'CommentController')->middleware('auth');
