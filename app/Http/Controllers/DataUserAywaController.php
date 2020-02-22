<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use DB;
Use Alert;
use Crypt;

class DataUserAywaController extends Controller
{

    public function show_all() {
      $all_user = User::all();
      if (session('success_message')) {
        Alert::success('Berhasil', session('success_message'));
      }

      return view('admin.data_pengguna_aywa', ['user' => $all_user]);
    }

    public function register(Request $request)
    {

      $user = new User;
      $token = str::random(70);
      // dd($token);

     $userx = User::where('email', $request->email)->first();

     if($userx) {
      Alert::error('Gagal Menyimpan Data', 'Email Telah Ada');

      return redirect('adm/data_user_aywa');

     } else {

      $valid = Validator::make($request->all(), [
        'status' => ['required']
      ]);

      $valid_photo = Validator::make($request->all(), [
        'image' => ['required', 'image', 'max:50000', 'mimes:jpeg,bmp,png,jpg']
      ]);
      
      $image = $request->file('image');
      
      if($valid_photo->fails()) {
        Alert::error('Gagal Menyimpan Data', 'Pastikan format foto yang dimasukan valid');
        return redirect('adm/data_user_aywa');
      } 
      
      if($valid->fails()) {
        Alert::error('Gagal Menyimpan Data', 'Masukan Data Dengan Valid');
        return redirect('adm/data_user_aywa');
      }

      $parse_image = "users_".time().'.'.$image->getClientOriginalExtension();
      $image->move(public_path('images/user_aywa/'), $parse_image);

      $form_data = array(
        'name' => $request['name'],
        'email' => $request['email'],
        'no_hp' => $request['no_telp'],
        'level' => $request['status'],
        'remember_token' => $token,
        'password' => Hash::make($request['password']),
        'image' => $parse_image
      );
 
      User::create($form_data);
      return redirect('adm/data_user_aywa')->withSuccessMessage('Data Berhasil Ditambahkan');

     }

    }

    public function update(Request $request) {
      $id = $request->id_karyawan;
      $user = User::find($id);

      $image_name = $user->image;
      $image = $request->image;

      if ($image) {

         $valid = Validator::make($request->all(), [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255'],
          'no_hp' => ['required','numeric', 'min:15'],
          'level' => ['required'],
        ]);

        $validator = Validator::make($request->all(), [
          'image' => ['required', 'image', 'max:50000', 'mimes:jpeg,bmp,png,jpg']
        ]);

        if($validator->fails()) {
          Alert::error('Gagal Menyimpan Data','Terjadi Kesalahan Mengupload Foto');
          return redirect('adm/data_user_aywa');
        } elseif($valid->fails()) {
          Alert::error('Gagal Menyimpan Data', 'Pastikan Data Yang Dimasukan Valid');
        }

        File::delete(public_path('images/user_aywa/'). $user->image);
        // dd($image);
        $extension = $request->file('image')->getClientOriginalExtension();
        $image_name = "user_".time() . '.' . $extension;
        $image->move(public_path('images/user_aywa/'), $image_name);

        $form_data = array(
          'image' => $image_name,
          'name' => $request['name'],
          'email' => $request['email'],
          'no_hp' => $request['no_telp'],
          'level' => $request['level'],
        );
          $user->where('id', $id)->update($form_data);
          return redirect('adm/data_user_aywa')->withSuccessMessage('Data Berhasil Diupdate');
      }

      Validator::make($request->all(), [
        'image' => ['required', 'image', 'mimes:jpeg,bmp,png,jpg', 'max:5000'],
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'no_hp' => ['required', 'string', 'max:255'],
        'status' => ['required'],
      ]);
      // dd($request->name);

      $form_data = array(
        'name' => $request['name'],
        'email' => $request['email'],
        'no_hp' => $request['no_telp'],
        'level' => $request['level'],
      );

        $user->where('id', $id)->update($form_data);
        return redirect('adm/data_user_aywa')->withSuccessMessage('Data Berhasil Diupdate');
    }

    public function delete(Request $request, $id) {
      $delete_user = User::find($id);

      if (File::exists(public_path('images/user_aywa/'). $delete_user->image)) {
        File::delete(public_path('images/user_aywa/'). $delete_user->image);
        $delete_user -> delete();
      }

      $delete_user -> delete();
      return redirect('adm/data_user_aywa') -> withSuccessMessage('Data Berhasil Dihapus');
    }

    public function changePassword($id) {
      $datas = User::find($id);

      echo json_encode($datas);
    }

    public function updatePassword(Request $req) {
      $datas = User::find($req->get('id_user'));
      $datas->password = Hash::make($req->new_password);
      $datas->save();

      // dd($datas);

      return redirect('adm/data_user_aywa') -> withSuccessMessage('Password Berhasil Diubah');
    }

    public function getUserId($id) {
      $datas = User::find($id);

      echo json_encode($datas);
    }
}
