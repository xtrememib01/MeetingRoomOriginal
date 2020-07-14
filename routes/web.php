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

Route::view('/','welcome');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'BookRoomController@index')->name('home');
Route::view('/home','welcome');

Route::put('/bookroom', 'BookRoomController@update');
Route::resource('/bookroom', 'BookRoomController');
Route::get('/events','BookRoomController@events');

Route::get('/lapupd','BookRoomController@lapupd');

Route::view('/communication','communication.index');

Route::delete('/bookroom/{bookroom}', 'BookRoomController@destroy')->middleware(['auth', 'password.confirm']);

Route::get('/sendSms/{bookroom}', 'BookRoomController@smsOngc');


