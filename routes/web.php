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



Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/users', 'UserController@getAllUsers');
    Route::get('/users/store', 'UserController@create');
    Route::post('/users/store', 'UserController@store');
    Route::post('/users/update/{id}', 'UserController@update');
    Route::get('/users/update/{id}', 'UserController@edit');
    Route::get('/users/delete/{id}', 'UserController@remove');
    Route::post('/users/delete/{id}', 'UserController@delete');
});

Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@login');
