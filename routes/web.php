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

Route::resource('articles', 'ArticleController');

Route::resource('categories', 'CategoryController', ['only' => ['show']]);

Route::get('archive', 'ArchiveController@index')->name('archive.index');

Route::resource('tags', 'TagController', ['only' => ['index', 'show']]);

// 后台管理系统
Route::group(['prefix' => 'admin'], function () {
    // 登录
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // 首页
    Route::get('/', 'AdminController@index')->name('admin');

});
