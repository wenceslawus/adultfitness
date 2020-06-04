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

if (env('APP_ENV') === 'local') {
    Route::get('test', 'TestController@test');
}

Route::get('index.php', 'WelcomeController@toIndex');
Route::get('index.html', 'WelcomeController@toIndex');

Route::get('/artivate_trainer/{token}', 'Auth\RegisterController@activateTrainer');
Route::get('/', 'WelcomeController@index')->name('home');
Route::get('/sitemap.xml', 'WelcomeController@sitemap');
Route::get('/{param}', 'WelcomeController@welcome')->where('param', '.*');

/*
Route::get('video/playlists', 'playlistController@index');
Route::post('video/playlists/new', 'playlistController@store');
Route::get('video/playlists/{id}', 'playlistController@getList');
Route::post('video/playlists/edit', 'playlistController@update');
Route::post('video/playlists/{id}/delete', 'playlistController@delete');
Route::post('video/addBookmark', 'playlistController@attach');
//*/
