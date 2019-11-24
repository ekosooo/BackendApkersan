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

Route::group(['middleware' => 'auth'], function (){
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::resource('kasus', 'KasusController');
    Route::get('kasus/create', 'KasusController@pindah')->name('kasus.pindah');
    Route::resource('kekerasan', 'KekerasanController');
    Route::get('kekerasan/create', 'KekerasanController@pindah')->name('kekerasan.pindah');
    Route::get('/pengaduan/detail/{id}', 'PengaduanController@detail')->name('pengaduan.detail');
    Route::get('/pengaduan', 'PengaduanController@index')->name('pengaduan.index');
    Route::get('/map', 'MapController@index')->name('map.index');
    Route::put('/pengaduan/verifikasi/{id}', 'PengaduanController@verifikasi')->name('pengaduan.verifikasi');

    Route::get('/user', 'UserController@indexPengguna')->name('index.pengguna');
    Route::get('/user/{id}', 'UserController@showPengguna')->name('show.pengguna');

    Route::get('/admin', 'UserController@indexAdmin')->name('index.admin');
    Route::get('/admin/{id}', 'UserController@showAdmin')->name('show.admin');
    Route::get('admin/create/', 'UserController@create')->name('admin.pindah');
    Route::patch('/admin/update/{id}', 'UserController@updateAdmin')->name('admin.update');
    Route::post('/admin/register', 'UserController@RegisterAdmin')->name('admin.store');
    Route::delete('/admin/delete', 'UserController@destroyAdmin')->name('admin.destroy');

});

Route::get('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('admin.logout');
Route::post('/admin/login', 'UserController@LoginAdmin')->name('admin.login');