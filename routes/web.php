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


Route::get('/', [
    'uses'=>'HomePageController@index',
    'as'=>'index'
]);

Route::get('/listing', [
    'uses'=>'ListingController@index',
    'as'=>'listing'
]);

Route::get('/details', [
    'uses'=>'DetailsController@index',
    'as'=>'detail'
]);
Route::group(['prefix' => 'back', 'middleware'=>'auth'], function () {

    Route::get('/', [
        'uses'=>'Admin\DashboardController@index',
        'as'=>'back'
    ]);
    // Category
    Route::get('/categories', [
        'uses'=>'Admin\CategoryController@index',
        'as'=>'categories'
    ]);

    Route::get('/categories/create', [
        'uses'=>'Admin\CategoryController@create',
        'as'=>'categories.create'
    ]);
    Route::post('/categories/store', [
        'uses'=>'Admin\CategoryController@store',
        'as'=>'categories.store'
    ]);


    Route::get('/categories/edit/{id}', [
        'uses'=>'Admin\CategoryController@edit',
        'as'=>'categories.edit'
    ]);

    Route::post('/categories/update/{id}', [
        'uses'=>'Admin\CategoryController@update',
        'as'=>'categories.update'
    ]);

    Route::get('/categories/delete/{id}', [
        'uses'=>'Admin\CategoryController@destroy',
        'as'=>'categories.delete'
    ]);

    Route::post('/categories/status/{id}', [
        'uses'=>'Admin\CategoryController@status',
        'as'=>'categories.status'
    ]);



    // permission
    Route::get('/permission', [
        'uses'=>'Admin\PermissionController@index',
        'as'=>'permission'
    ]);
    Route::get('/permission/create', [
        'uses'=>'Admin\PermissionController@create',
        'as'=>'permission.create'
    ]);
    Route::post('/permission/store', [
        'uses'=>'Admin\PermissionController@store',
        'as'=>'permission.store'

    ]);


    Route::get('/permission/edit/{id}', [
        'uses'=>'Admin\PermissionController@edit',
        'as'=>'permission.edit'

    ]);
    Route::post('/permission/update/{id}', [
        'uses'=>'Admin\PermissionController@update',
        'as'=>'permission.update'

    ]);

    Route::get('/permission/delete/{id}', [
        'uses'=>'Admin\PermissionController@destroy',
        'as'=>'permission.delete'

    ]);



    // Roles
    Route::get('/roles', [
        'uses'=>'Admin\RolesController@index',
        'as'=>'roles'

    ]);

    Route::get('/roles/create', [
        'uses'=>'Admin\RolesController@create',
        'as'=>'roles.create'

    ]);

    Route::post('/roles/store', [
        'uses'=>'Admin\RolesController@store',
        'as'=>'roles.store'

    ]);
    Route::get('/roles/edit/{id}', [
        'uses'=>'Admin\RolesController@edit',
        'as'=>'roles.edit'

    ]);
    Route::post('/roles/update/{id}', [
        'uses'=>'Admin\RolesController@update',
        'as'=>'roles.update'

    ]);
    Route::get('/roles/delete/{id}', [
        'uses'=>'Admin\RolesController@destroy',
        'as'=>'roles.delete'

    ]);

    // Author
    Route::get('/authors', [
        'uses'=>'Admin\AuthorController@index',
        'as'=>'authors'

    ]);
    Route::get('/authors/create', [
        'uses'=>'Admin\AuthorController@create',
        'as'=>'authors.create'

    ]);


    Route::post('/authors/store', [
        'uses'=>'Admin\AuthorController@store',
        'as'=>'authors.store'

    ]);

    Route::get('/authors/edit/{id}', [
        'uses'=>'Admin\AuthorController@edit',
        'as'=>'authors.edit'

    ]);

    Route::post('/authors/update/{id}', [
        'uses'=>'Admin\AuthorController@update',
        'as'=>'authors.update'

    ]);

    Route::get('/authors/delete/{id}', [
        'uses'=>'Admin\AuthorController@destroy',
        'as'=>'authors.delete'

    ]);

    // post

    Route::get('/posts', [
        'uses'=>'Admin\PostController@index',
        'as'=>'posts'

    ]);
    Route::get('/posts/create', [
        'uses'=>'Admin\PostController@create',
        'as'=>'posts.create'

    ]);

    Route::post('/posts/store', [
        'uses'=>'Admin\PostController@store',
        'as'=>'posts.store'

    ]);

    Route::get('/posts/edit/{id}', [
        'uses'=>'Admin\PostController@edit',
        'as'=>'posts.edit'

    ]);

    Route::post('/posts/update/{id}', [
        'uses'=>'Admin\PostController@update',
        'as'=>'posts.update'

    ]);

    Route::get('/posts/delete/{id}', [
        'uses'=>'Admin\PostController@destroy',
        'as'=>'posts.delete'

    ]);

    Route::post('/posts/status/{id}', [
        'uses'=>'Admin\PostController@status',
        'as'=>'posts.status'
    ]);
    Route::post('/posts/hot_news/{id}', [
        'uses'=>'Admin\PostController@hot_news',
        'as'=>'posts.hot_news'
    ]);


    // comments

    Route::get('/comments', [
        'uses'=>'Admin\CommentController@index',
        'as'=>'comments'

    ]);

    Route::post('/comments/reply_store', [
        'uses'=>'Admin\CommentController@reply_store',
        'as'=>'comments.reply_store'

    ]);
    Route::get('/comments/reply/{id}', [
        'uses'=>'Admin\CommentController@reply',
        'as'=>'comments.reply'

    ]);
    Route::post('/commets/status/{id}', [
        'uses'=>'Admin\CommentController@status',
        'as'=>'comments.status'
    ]);


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
