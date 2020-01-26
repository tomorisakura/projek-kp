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
    return view('landing.hello_aywa');
});

Route::get('/adm', function () {
    return view('auth.login');
});

Auth::routes();
// Route::group(['middleware' => ['auth']], function () {

  Route::get('/adm/dashboard','AdminController@home') -> name('dashboard');

  //route pemilik hewan
  Route::get('/adm/pemilik-hewan', ['as' => 'view.pelanggan', 'uses' => 'PelangganController@index']);
  Route::post('/adm/pemilik-hewan/', ['as' => 'register.pelanggan', 'uses' => 'PelangganController@register']);
  Route::get('/adm/pemilik-hewan/{id}', ['as' => 'getId.pelanggan', 'uses' => 'PelangganController@getData']);
  Route::post('/adm/pemilik-hewan/update/{id}', ['as' => 'edit.pelanggan', 'uses' => 'PelangganController@update']);
  Route::delete('/adm/pemilik-hewan/hapus/{id}', ['as' => 'hapus.pelanggan', 'uses' => 'PelangganController@delete']);

  //route penyakit 
  Route::get('/adm/penyakit', ['as' => 'view.penyakit', 'uses' => 'PenyakitController@index']);
  Route::post('/adm/penyakit/', ['as' => 'create.penyakit', 'uses' => 'PenyakitController@create']);
  Route::get('/adm/penyakit/get/{id}', ['as' => 'get.penyakit', 'uses' => 'PenyakitController@getDataPenyakit']);
  Route::post('/adm/penyakit/update/{id}', ['as' => 'update.penyakit', 'uses' => 'PenyakitController@update']);
  Route::delete('/adm/penyakit/delete/{id}', ['as' => 'delete.penyakit', 'uses' => 'PenyakitController@delete']);

  //route jenis hewan
  Route::get('/adm/jenis-hewan', ['as' => 'view.jenis', 'uses' => 'JenisController@index']);
  Route::post('/adm/jenis-hewan/', ['as' => 'create.jenis', 'uses' => 'JenisController@create']);
  Route::get('/adm/jenis-hewan/get/{id}', ['as' => 'get.jenis', 'uses' => 'JenisController@getDataJenis']);
  Route::post('/adm/jenis-hewan/update/{id}', ['as' => 'update.jenis', 'uses' => 'JenisController@update']);
  Route::delete('/adm/jenis-hewan/hapus/{id}', ['as' => 'delete.jenis', 'uses' => 'JenisController@delete']);


  // route rekam medis
  Route::get('/adm/rekam-medis',['as' => 'medis','uses' => 'RmedicalController@index']);
  Route::post('/adm/rekam-medis/store', ['as' => 'store.medis', 'uses' => 'RmedicalController@storeMedis']);
  Route::get('/adm/rekam-medis/get/{id}',['as' => 'm_pelanggan','uses' => 'RmedicalController@getDataPemilik']);
  Route::get('/adm/rekam-medis/get/hewan/{id}',['as' => 'get.dhewan','uses' => 'RmedicalController@getDataHewan']);

  // route penitipan
  Route::get('/adm/penitipan',['as' => 'pethotel','uses' => 'PetPenitipanController@index']);
  Route::get('/adm/penitipan/get/{id}',['as' => 'get.pemilik','uses' => 'PetPenitipanController@getDataPemilik']);
  Route::post('/adm/penitipan-hewan/{id}', ['as' => 'store.penitipan', 'uses' => 'PetPenitipanController@storePenitipan']);

  //data_medis
  Route::get('/adm/data-medis',['as' => 'data_medis','uses' => 'DataMedisController@index']);
  Route::get('/adm/detail-medis/get/{id}',['as' => 'detail.medis','uses' => 'DataMedisController@detail_transaksi']);


  //data_penitipan
  Route::get('/adm/data-penitipan',['as' => 'data_penitipan','uses' => 'DataPenitipanController@index']);


  // route data karyawan
  Route::get('/adm/data_user_aywa', ['as' => 'pegawai', 'uses' => 'DataUserAywaController@view_data']);
  Route::get('/adm/data_user_aywa', ['as' => 'pegawai', 'uses' => 'DataUserAywaController@show_all']);
  Route::patch('/adm/data_user_aywa/{id}', ['as' => 'update', 'uses' => 'DataUserAywaController@update']);
  Route::get('/adm/data_user_aywa/{id}/delete', ['as' => 'delete', 'uses' => 'DataUserAywaController@delete']);
  Route::post('/adm/data_user_aywa', ['as' => 'regis', 'uses' => 'DataUserAywaController@register']);
// });