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

Route::get('/', 'ArticleController@index')->name('index');

Route::resource('articles', 'ArticleController', ['only' => ['index', 'show']]);

Route::resource('categories', 'CategoryController', ['only' => ['show']]);

Route::resource('tags', 'TagController', ['only' => ['index', 'show']]);

Route::get('archive', 'ArchiveController@index')->name('archive.index');

Route::get('admin', 'AdminController@index')->name('admin');
