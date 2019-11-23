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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'DashboardController@index')->name('dashboard.index');
Route::resource('kasus', 'KasusController');
Route::get('kasus/create', 'KasusController@pindah')->name('kasus.pindah');
Route::resource('kekerasan', 'KekerasanController');
Route::get('kekerasan/create', 'KekerasanController@pindah')->name('kekerasan.pindah');
Route::get('/pengaduan/detail/{id}', 'PengaduanController@detail')->name('pengaduan.detail');
Route::get('/pengaduan', 'PengaduanController@index')->name('pengaduan.index');
Route::get('/map', 'MapController@index')->name('map.index');
Route::put('/pengaduan/verifikasi/{id}', 'PengaduanController@verifikasi')->name('pengaduan.verifikasi');

Route::get('/login', 'UserController@login');
Route::post('/admin/login', 'UserController@LoginAdmin')->name('login');