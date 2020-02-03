<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use DB;
Use Alert;
use Crypt;

class DataUserAywaController extends Controller
{

    public function show_all() {
      $all_user = User::all();
      if (session('success_message')) {
        Alert::success('Berhasil Ditambahkan', session('success_message'));
      }

      return view('admin.data_pengguna_aywa', ['user' => $all_user]);
    }

    public function register(Request $request)
    {

      $user = new User;

      Validator::make($request->all(), [
       'name' => ['required', 'string', 'max:255'],
       'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
       'no_hp' => ['required', 'string', 'max:255'],
       'status' => ['required'],
       'image' => ['required', 'image', 'mimes:jpeg,bmp,png,jpg', 'max:5000']
     ]);

      $image = $request->file('image');
      $new_name = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('images/'), $new_name);
      $form_data = array(
        'name' => $request['name'],
        'email' => $request['email'],
        'username' => $request['username'],
        'no_hp' => $request['no_telp'],
        'level' => $request['status'],
        'password' => Hash::make($request['password']),
        'image' => $new_name
      );

      User::create($form_data);
      $pelanggan= User::all();

      return redirect('adm/data_user_aywa')->withSuccessMessage('Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id) {
      $user = User::find($id);

      $image_name = $user->image;
      $image = $request->image;

      if ($image) {

         Validator::make($request->all(), [
          'image' => ['required', 'image', 'mimes:jpeg,bmp,png,jpg', 'max:5000'],
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'no_hp' => ['required', 'string', 'max:255'],
          'level' => ['required'],
        ]);

        Storage::delete(public_path('images/'), $image_name);
        // dd($image);
        $extension = rand() . '.' . $request->file('image')->getClientOriginalExtension();
        $image_name = rand() . '.' . $extension;
        $image->move(public_path('images/'), $image_name);

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

    public function delete($id, Request $request) {
      $delete_user = User::find($id);
      $image_path = "/images/".$request->image;

      if (File::exists($image_path)) {
        @unlink($image_path);
        $delete_user -> delete();
      }

      $delete_user -> delete();
      // dd($delete_user);
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
}
