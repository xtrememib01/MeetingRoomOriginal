<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/home', 'BookRoomController@index')->name('home');
Route::get('/home', function(){
    return view('welcome');
});

Route::put('/bookroom', 'BookRoomController@update');
Route::resource('/bookroom', 'BookRoomController');
Route::get('/events','BookRoomController@events');

Route::get('/lapupd','BookRoomController@lapupd');


//Route::resource('/communication','CommunicationController');
Route::get('/communication', function(){
    return view('communication.index');
}); 

Route::delete('/bookroom/{bookroom}', 'BookRoomController@destroy',function () {
})->middleware(['auth', 'password.confirm']);


