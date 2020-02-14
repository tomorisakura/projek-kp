<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
Use Alert;

class LoginController extends Controller
{
    public function index() {

        if (session('success_message')) {
            Alert::success('Berhasil Ditambahkan', session('success_message'));
          }

        return view('auth.login');
    }

    public function login(Request $req) {
        $email = $req->email;
        // $data = DB::table('users')->where('email', $email)->first();
        if(Auth::attempt($req->only('email', 'password'))) {
            Alert::success('Login Berhasil');
            return redirect('/adm/dashboard');
        } else {
            Alert::error('Gagal Login','Data Email Dan Password Salah');
            return redirect('/adm/login');
        }

        Alert::error('Gagal Login','Data Email Dan Password Salah');

        return redirect('/adm/login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/adm/login');
    }
}
