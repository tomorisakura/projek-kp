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

  public function home(Request $req) {

    $sum_penitipan =  Penitipan::whereYear('created_at', now())->whereMonth('created_at', now())->where('status_pembayaran', 'Lunas')->sum('total_biaya');
    $sum_medis = Medis::whereYear('created_at', now())->whereMonth('created_at', now())->where('status_pembayaran', 'Lunas')->sum('total_biaya');

    $datas = [];
    $data_medis = [];

    $datas[] = Penitipan::whereYear('created_at', now())->whereMonth('created_at', now())->where('status_pembayaran', 'Lunas')->sum('total_biaya');
    $data_medis[] = Medis::whereYear('created_at', now())->whereMonth('created_at', now())->sum('total_biaya');
    
    $penitipan_belum = DB::table('transaksi_penitipan')
    ->where('status_pembayaran', '=', 'Belum Lunas')
    ->get();

    $penitipan_lunas = DB::table('transaksi_penitipan')
    ->where('status_pembayaran', '=', 'Lunas')
    ->get();

    $medis_belum = DB::table('transaksi_medis')
    ->where('status_pembayaran', '=', 'Belum Lunas')
    ->get();

    $medis_lunas = DB::table('transaksi_medis')
    ->where('status_pembayaran', '=', 'Lunas')
    ->get();

    // dd(json_encode($penitipan_belum));

    $total = array_map('intval', $datas);
    $total_medis = array_map('intval', $data_medis);


    return view('admin.dashboard', compact('total', 'total_medis', 'sum_penitipan', 'sum_medis', 'penitipan_belum', 'medis_belum', 'medis_lunas', 'penitipan_lunas'));
  }

  public function getDataGrafik(Request $req) {

    $datas = [];
    $data_medis = [];

    $datas[] = Penitipan::whereYear('created_at', now())->whereMonth('created_at', $req->bulan)->sum('total_biaya');
    $data_medis[] = Medis::whereYear('created_at', now())->whereMonth('created_at', $req->bulan)->sum('total_biaya');
    $total = array_map('intval', $datas);
    $total_medis = array_map('intval', $data_medis);

    return view('layouts.grafik', compact('total', 'total_medis'));
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
