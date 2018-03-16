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

Route::group(['middleware'=>'checksession'],function(){
    Route::get('/dashboard', function () {
        return view('layouts.dashboard');
    });    
    Route::get('/siswa', function () {
        return view('pages.siswaview');
    });
    Route::get('/guru', function () {
        return view('pages.masterdataguru');
    });
    Route::get('/kelas', function () {
        return view('pages.masterdatakelas');
    });
    Route::get('/users', function () {
        return view('pages.usermanagement');
    });
    Route::get('/userapproval', function () {
        return view('pages.userapproval');
    });
    Route::get('/jadwalpelajaran', function () {
        return view('pages.jadwalpelajaran');
    });
    Route::get('/rangkumannilai', function () {
        return view('pages.rangkumannilai');
    });
    Route::get('/rekapabsen', function () {
        return view('pages.rekapabsen');
    });
});
Route::get('/', function () {
    return view('pages.login');
});
Route::post('/authentication','usersController@auth');
Route::post('/api/users/changestatus','usersController@changestatus');
Route::get('/users/statussiswa','usersController@getsiswa');
Route::get('/logout','usersController@logout');