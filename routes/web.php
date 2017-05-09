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

Route::get('/', function() {
    return view('index');
});

Route::get('/gallery', 'GalleryController@index');
Route::get('/info', 'InfoController@index');
Route::get('/contact', 'ContactController@index');

Route::get('/blog', 'BlogController@index');
Route::get('/blog/create', 'BlogController@newPost');
Route::post('/blog/create', 'BlogController@create');
Route::get('/blog/{slug}', 'BlogController@showPost');