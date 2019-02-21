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

Route::group([
    'namespace' => 'Admin',
], function (Route $route) {

    $route->group([
        'prefix' => 'auth',
    ], function (Route $route) {
        $route->post('login', 'AuthController@login')->name('login');
        $route->get('logout', 'AuthController@logout')->name('logout');
        $route->get('user', 'AuthController@user')->name('auth.user');
    });
    
    $route->group([
        'middleware' => 'refresh',
    ], function (Route $route) {
        $route->resource('articles', 'ArticleController', ['except' => ['create']]);

        $route->resource('categories', 'CategoryController', ['except' => ['create', 'edit']]);

        $route->resource('tags', 'TagController', ['except' => ['create', 'edit']]);

        $route->resource('abouts', 'AboutController', ['only' => ['show', 'update']]);

        $route->post('upload/image', 'UploadController@image')->name('upload.image');

        $route->get('visitors', 'VisitorController@index');

        $route->get('dashboard', 'DashboardController@index');
        $route->get('dashboard/traffic', 'DashboardController@traffic');
    });
});
