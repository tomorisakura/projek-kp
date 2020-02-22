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

// Route::get('/adm', function () {
//     return view('auth.login');
// });

Route::get('/adm/login', ['as' => 'aywa.login', 'uses' => 'LoginController@index']);
Route::post('/adm/login', ['as' => 'post.login', 'uses' => 'LoginController@login']);
Route::get('/adm/logout', ['as' => 'get.logout', 'uses' => 'LoginController@logout']);

Auth::routes();
Route::group(['middleware' => ['auth']], function () {

  Route::get('/adm/dashboard','AdminController@home') -> name('dashboard');
  Route::get('/adm/dashboard/get/users','AdminController@getDataUser');
  Route::get('/adm/dashboard/get/pelanggan','AdminController@getDataPelanggan');
  Route::get('/adm/dashboard/get/penitipan','AdminController@getDataPenitipan');
  Route::post('/adm/dashboard/post','AdminController@getDataGrafik') -> name('post.grafik');
  Route::get('/adm/dashboard/get','AdminController@getDataGrafik') -> name('get.grafik');

  //route pemilik hewan
  Route::get('/adm/pemilik-hewan', ['as' => 'view.pelanggan', 'uses' => 'PelangganController@index']);
  Route::post('/adm/pemilik-hewan/', ['as' => 'register.pelanggan', 'uses' => 'PelangganController@register']);
  Route::get('/adm/pemilik-hewan/{id}', ['as' => 'getId.pelanggan', 'uses' => 'PelangganController@getData']);
  Route::post('/adm/pemilik-hewan/update', ['as' => 'edit.pelanggan', 'uses' => 'PelangganController@update']);
  Route::delete('/adm/pemilik-hewan/hapus/{id}', ['as' => 'hapus.pelanggan', 'uses' => 'PelangganController@delete']);

  //route penyakit 
  Route::get('/adm/penyakit', ['as' => 'view.penyakit', 'uses' => 'PenyakitController@index']);
  Route::post('/adm/penyakit/', ['as' => 'create.penyakit', 'uses' => 'PenyakitController@create']);
  Route::get('/adm/penyakit/get/{id}', ['as' => 'get.penyakit', 'uses' => 'PenyakitController@getDataPenyakit']);
  Route::post('/adm/penyakit/update/', ['as' => 'update.penyakit', 'uses' => 'PenyakitController@update']);
  Route::delete('/adm/penyakit/delete/{id}', ['as' => 'delete.penyakit', 'uses' => 'PenyakitController@delete']);

  //route jenis hewan
  Route::get('/adm/jenis-hewan', ['as' => 'view.jenis', 'uses' => 'JenisController@index']);
  Route::post('/adm/jenis-hewan/', ['as' => 'create.jenis', 'uses' => 'JenisController@create']);
  Route::get('/adm/jenis-hewan/get/{id}', ['as' => 'get.jenis', 'uses' => 'JenisController@getDataJenis']);
  Route::post('/adm/jenis-hewan/update/', ['as' => 'update.jenis', 'uses' => 'JenisController@update']);
  Route::delete('/adm/jenis-hewan/hapus/{id}', ['as' => 'delete.jenis', 'uses' => 'JenisController@delete']);


  // route rekam medis
  Route::get('/adm/rekam-medis',['as' => 'medis','uses' => 'RmedicalController@index']);
  Route::post('/adm/rekam-medis/store', ['as' => 'store.medis', 'uses' => 'RmedicalController@storeMedis']);
  Route::get('/adm/rekam-medis/get/{id}',['as' => 'm_pelanggan','uses' => 'RmedicalController@getDataPemilik']);
  Route::get('/adm/rekam-medis/get/hewan/{id}',['as' => 'get.dhewan','uses' => 'RmedicalController@getDataHewan']);
  Route::get('/adm/rekam-medis/get/detail/{id}',['as' => 'get.detail_hewan','uses' => 'RmedicalController@getDataDetailMedis']);

  //route Details Transaksi
  Route::get('/adm/detail-transaksi/get/',['as' => 'get.det_transaksi','uses' => 'RmedicalController@getDataDetail']);


  // route penitipan
  Route::get('/adm/penitipan',['as' => 'pethotel','uses' => 'PetPenitipanController@index']);
  Route::get('/adm/penitipan/get/{id}',['as' => 'get.pemilik','uses' => 'PetPenitipanController@getDataPemilik']);
  Route::post('/adm/penitipan-hewan/store', ['as' => 'store.penitipan', 'uses' => 'PetPenitipanController@storePenitipan']);
  Route::get('/adm/detail-penitipan/get', ['as' => 'get.det_penitipan', 'uses' => 'PetPenitipanController@getDataDetail']);
  Route::get('/adm/detail-penitipan/get/detail/{id}', ['as' => 'detail_get', 'uses' => 'PetPenitipanController@getDataDetailPenitipan']);

  //data_medis
  Route::get('/adm/data-medis',['as' => 'data_medis','uses' => 'DataMedisController@index']);
  Route::get('/adm/detail-medis/get/{id}',['as' => 'detail.medis','uses' => 'DataMedisController@detail_transaksi']);
  Route::get('/adm/get/transaksi',['as' => 'get.data_transaksi','uses' => 'DataMedisController@transaksi']);
  Route::get('/adm/data-medis/cetak/{id}',['as' => 'get.pdf_medis','uses' => 'DataMedisController@pdf']);
  Route::get('/adm/detail-price/get/{id}',['as' => 'get.total_medis','uses' => 'DataMedisController@getDetailTotal']);


  //data_penitipan
  Route::get('/adm/data-penitipan',['as' => 'data_penitipan','uses' => 'DataPenitipanController@index']);
  Route::get('/adm/data-penitipan/get/{id}',['as' => 'detail.penitipan','uses' => 'DataPenitipanController@detail_transaksi']);
  Route::get('/adm/detail-penitipan/cetak/{id}',['as' => 'get.pdf_penitipan','uses' => 'DataPenitipanController@pdf']);
  Route::post('/adm/detail-penitipan/update',['as' => 'get.update_detail','uses' => 'DataPenitipanController@updateDetailPenitipan']);


  // route data karyawan
  Route::get('/adm/data_user_aywa', ['as' => 'pegawai', 'uses' => 'DataUserAywaController@view_data']);
  Route::get('/adm/data_user_aywa', ['as' => 'pegawai', 'uses' => 'DataUserAywaController@show_all']);
  Route::post('/adm/data_user_aywa/update', ['as' => 'update', 'uses' => 'DataUserAywaController@update']);
  Route::get('/adm/data_user_aywa/{id}/delete', ['as' => 'delete', 'uses' => 'DataUserAywaController@delete']);
  Route::post('/adm/data_user_aywa', ['as' => 'regis', 'uses' => 'DataUserAywaController@register']);
  Route::get('/adm/data_user_pw/change/{id}', ['as' => 'change.password', 'uses' => 'DataUserAywaController@changePassword']);
  Route::post('/adm/data_user_aywa/update-pw', ['as' => 'update.pw', 'uses' => 'DataUserAywaController@updatePassword']);
  Route::get('/adm/data_user_aywa/get/user/{id}', ['as' => 'get.user', 'uses' => 'DataUserAywaController@getUserId']);

  //route Telegram
  Route::post('/adm/update-activity/{id}', 'TelegramController@updateActivity')->name('telebot');
  Route::post('/adm/send-message-telebot/{id}', 'TelegramController@sendMessage')->name('telebot_message');
  Route::post('/adm/send-message-medis-telebot/{id}', 'TelegramController@sendMessageMedis')->name('telebot_message_medis');
});