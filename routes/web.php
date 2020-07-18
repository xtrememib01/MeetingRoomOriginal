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

// // });

Auth::routes();


// Route::get('/','welcome');

// // Route::get('/', function () {
// //     return view('welcome');


Route::get('/','BookRoomController@index');
Route::get('/home','BookRoomController@index');


Route::put('/bookroom', 'BookRoomController@update');

Route::resource('/bookroom', 'BookRoomController');

Route::get('/events','BookRoomController@events');

// Route::delete('/bookroom/{bookroom}', 'BookRoomController@destroy')->middleware(['auth', 'password.confirm']);

Route::get('/sendSms/{bookroom}', 'BookRoomController@smsOngc');

Route::get('/sendSMS',function(){
    return '123';
    return view('sendSMS');
});

