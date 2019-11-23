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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kasus', 'KasusController@kasus');
Route::get('/kekerasan', 'KekerasanController@kekerasan');
Route::post('/register/user', 'UserController@RegisterUser');
Route::post('/login/user', 'UserController@LoginUser');
Route::post('/pengaduan', 'PengaduanController@store');
Route::get('/pengaduan/{id}', 'PengaduanController@show');
Route::post('/user/token/{id}', 'UserController@SaveTokenFCM');
Route::post('/user/update/{id}', 'UserController@updateProfile');

