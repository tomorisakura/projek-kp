<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Penitipan;
use App\Pelanggan;
use App\TransPenitipan;
use App\Medis;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class AdminController extends Controller
{

  public function home() {

    $penitipan = Penitipan::all();
    $medis = Medis::all();

    $datas = [];
    $data_medis = [];

    foreach($penitipan as $pet) {
      $datas[] = $pet->sum('total_biaya');
      $data_medis[] = $medis->sum('total_biaya');
    }

    $total = array_map('intval', $datas);

    // dd(json_encode($total));
    // dd(json_encode($data_medis));

    return view('admin.dashboard', compact('total', 'data_medis'));
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

  public function getDataUser() {
    $data = User::all();
    echo json_encode($data);
  }

  public function getDataPelanggan() {
    $data = Pelanggan::all();
    echo json_encode($data);
  }

  public function getDataPenitipan() {
    $data = TransPenitipan::all();
    echo json_encode($data);
  }

}
