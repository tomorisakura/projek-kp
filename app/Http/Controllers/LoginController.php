<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
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
        $password = $req->password;

        if(Auth::attempt($req->only('email', 'password'))) {
            Alert::success('Login Berhasil', 'Selamat Datang '.Auth::user()->name);
            return redirect('/adm/dashboard');
        } else {
            Alert::error('Gagal Login','Data Email atau Password Salah');
            return redirect('/adm/login');
        }

        Alert::error('Gagal Login','Data Email atau Password Salah');

        return redirect('/adm/login');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/adm/login');
    }
}
