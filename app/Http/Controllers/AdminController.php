<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;

class AdminController extends Controller
{

  public function home() {
    return view('admin.dashboard');
  }

  public function login() {
    return view('admin.login');
  }

  public function validasi(Request $request) {

    $this->validate($request, [
      'email' => 'required'
    ]);

    $data = User::where('email' , $request-> email)->first();
    $inp_email = $request->get('email');

    if ($data) {
      return view('admin.dashboard');
    }
    else
    {
      return redirect('adm/login')->with('gagal','email atau username salah');
    }
  }
}
