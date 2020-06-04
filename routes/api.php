<?php

use Illuminate\Http\Request;


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

// Proccess options request
Route::options('/{any}', function(){})->where('any', '.*');
Route::post('test', 'WelcomeController@test');

Route::resource('video', 'VideoController')->except(['create', 'show', 'update']);
Route::post('videos/sync', 'VideoController@sync');
Route::get('video/test', 'VideoController@sync');

// Auth routes
Route::get('user', 'UserController@profile');
Route::post('user/list', 'UserController@userList');
Route::post('user/setRole', 'UserController@setRole');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::post('become-trainer', 'Auth\RegisterController@become');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('restore', 'UserController@restore');
Route::post('forgot', 'UserController@forgot');


Route::get('/', 'IndexController@index')->name('main.page');
Route::get('index', 'IndexController@index')->name('main.page');
Route::get('search', 'SearchController@search');

Route::resource('categories', 'CategoriesController')->except(['create']);

// Blogs
Route::group(['prefix' => 'blogs'], function(){
    Route::resource('category', 'categoryController')->only(['index', 'show']);
    Route::resource('record', 'blogController')->only(['show']);
    Route::post('filter', 'blogController@getList');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('user/sendMail', 'UserController@sendMail');
    // Update my profile
    Route::post('saveMe', 'UserController@saveMe');
    Route::post('follow-trainer/{id}', 'trainerController@follow');

    //NBotifies
    Route::get('notify', 'notifyController@index')->name('notify_list');
    Route::put('notify', 'notifyController@markRead');
    Route::post('notify', 'notifyController@notyStatus');

    // Blogs
    Route::group(['prefix' => 'blogs'], function(){
        Route::resource('category', 'categoryController')->only(['edit', 'store', 'update']);
        Route::resource('record', 'blogController')->only(['edit', 'store', 'update']);
    });

    //Slider
    Route::resource('sliders', 'sliderController')->except(['index']);;

    Route::resource('programs', 'programController')->only(['edit', 'show', 'update', 'destroy', 'index']);

    Route::get('trainer/{id}', 'trainerController@show');

    // Commentary
    Route::resource('comment', 'commentaryController')->only(['store', 'update', 'destroy']);
    Route::get('/comment/child/{parent_id}', 'commentaryController@childs');
    Route::post('/comment/vote', 'voteController@vote');

    // Subscribing
    Route::group(['prefix' => 'subscribe'], function() {
        Route::post('/', 'subscribeController@store');
        Route::post('link', 'subscribeController@link');
    });

    Route::group(['prefix'=> 'upload'], function () {
        Route::post('avatar', 'fileController@uploadAvatar');
        Route::post('wallpaper', 'fileController@uploadwallpaper');

        Route::post('image', 'fileController@uploadImage');
        Route::post('file', 'fileController@uploadFile');
        Route::post('form', 'uploadController@upload');
        Route::post('setVideo', 'uploadController@makeVideo');
    });

    Route::get('video/edit', 'VideoController@indexEdit');
    Route::post('video/switch', 'VideoController@switch');
    Route::get('video/play/{id}', 'VideoController@play');


    Route::post('video/addLinked', 'VideoController@addLinked');
    Route::post('video/vote', 'voteController@vote');

    Route::get('video/playlists', 'playlistController@index');
    Route::post('video/playlists/new', 'playlistController@store');
    Route::post('video/playlists/edit', 'playlistController@update');
    Route::post('video/playlists/{id}/delete', 'playlistController@delete');
    Route::post('video/playlists/attach', 'playlistController@attach');
    Route::post('video/playlists/detach', 'playlistController@detach');
    Route::get('video/{id}', 'VideoController@show')->name('show_video');
    Route::put('video/{id}', 'VideoController@update')->name('video.update');
});

Route::post('ssr', 'pageController@putNSSR');

Route::get('all-sliders', 'sliderController@index');

Route::get('page/{link}', 'pageController@show');//->except(['create', 'edit', 'show']);
Route::group(['prefix' => 'email'], function(){
    Route::post('contactus', 'emailController@contactus');
    Route::post('feedback', 'emailController@feedback');
});//*/

Route::any('payhook', 'subscribeController@ccbillHook');
