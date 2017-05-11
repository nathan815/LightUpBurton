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

Route::get('/', 'HomeController@index');
Route::get('/info', 'InfoController@index');
Route::get('/contact', 'ContactController@index');

Route::get('/gallery/{year?}', 'GalleryController@index');
Route::get('/gallery/load/{last_id}', 'GalleryController@loadMore');

Route::get('/blog', 'BlogController@index');
Route::get('/blog/create', 'BlogController@newPost');
Route::post('/blog/create', 'BlogController@create');
Route::get('/blog/{slug}', 'BlogController@showPost');