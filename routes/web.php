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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


//queue
/*Route::get('/',function (){
    \App\Jobs\SendMessage::withChain([
        new \App\Jobs\SendEmail('email send'),
        new \App\Jobs\ShowResult('show result'),
    ])->dispatch('start job');
});*/

Route::resource('/','indexController');
Route::resource('/room','RoomController');
Route::resource('/comment','CommentController');
Route::get('/room-number/{id}',['uses'=>'RoomController@showRoom','as'=>'rooms']);

Route::get('login/{service}', ['uses' => 'Auth\LoginController@redirectToProvider','as' => 'loginSocialite'] );
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

