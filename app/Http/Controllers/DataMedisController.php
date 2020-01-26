<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use Illuminate\Support\Facades\DB;

class DataMedisController extends Controller
{
    public function index() {

      $pelanggan = Pelanggan::all();
      return view('admin.data_medis', compact('pelanggan'));
    }

    public function detail_transaksi(Request $request, $id) {
      $data_det = DB::table('detail_transaksi_medis')
      ->join('transaksi_medis', 'detail_transaksi_medis.id_medis', '=', 'transaksi_medis.id')
      ->join('jenis_hewan', 'detail_transaksi_medis.id_jenis', '=', 'jenis_hewan.id')
      ->join('penyakit', 'detail_transaksi_medis.id_penyakit', '=', 'penyakit.id')
      ->join('users', 'detail_transaksi_medis.id_petugas', '=', 'users.id')
      ->get();

      $data_trans = DB::table('transaksi_medis')
      ->join('pelanggan', 'transaksi_medis.id_pemilik', '=', 'pelanggan.id')
      ->select('transaksi_medis.*', 'pelanggan.nama_pemilik')
      ->where('pelanggan.id', '=' , $request->get($id))
      ->get();

      dd($data_trans);

      return view('admin.detail_trans_medis', compact('data_trans', 'data_det'));
    }
}
