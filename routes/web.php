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

Auth::routes();

Route::get('/', 'ArticleController@index')->name('index');

Route::resource('articles', 'ArticleController');

Route::resource('categories', 'CategoryController', ['only' => ['show']]);

Route::get('archive', 'ArchiveController@index')->name('archive.index');

Route::resource('tags', 'TagController', ['only' => ['index', 'show']]);

//Route::get('categories/{id}', 'CategoryController@show')->name('categories');

//Route::get('/home', 'HomeController@index')->name('home');
