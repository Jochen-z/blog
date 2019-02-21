<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Admin'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::get('logout', 'AuthController@logout')->name('logout');
        Route::get('user', 'AuthController@user')->name('auth.user');
    });
    
    Route::group(['middleware' => 'refresh'], function () {
        Route::resource('articles', 'ArticleController', ['except' => ['create']]);

        Route::resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);

        Route::resource('tags', 'TagController', ['except' => ['create', 'edit']]);

        Route::resource('abouts', 'AboutController', ['only' => ['show', 'update']]);

        Route::post('upload/image', 'UploadController@image')->name('upload.image');

        Route::get('operation/logs', 'OperationLogController@index');

        Route::get('dashboard', 'DashboardController@index');
        Route::get('dashboard/traffic', 'DashboardController@traffic');
    });
});
