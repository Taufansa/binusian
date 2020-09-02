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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','PagesController@index');
//Route::get('/regist','PagesController@regist');
//Route::post('/regist/create','PagesController@createUser');
Route::post('/loginmodal', 'PagesController@loginModal');
Route::post('/logout','PagesController@logout');
Route::get('/registerChild','PagesController@store');
Route::get('/dashboard/registered', 'PagesController@registered');
Route::get('/dashboard','PagesController@dashboard');
Route::get('/updateChild', 'PagesController@update');
Route::delete('/dashboard/registered/clear','PagesController@clearAll');


