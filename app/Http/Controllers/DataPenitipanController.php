<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPenitipanController extends Controller
{
    public function index() {

      $data = DB::table('hewan')
      ->join('pelanggan', 'hewan.id_pemilik', '=', 'pelanggan.id')
      ->join('penitipan', 'hewan.id', '=', 'penitipan.id_hewan')
      ->join('transaksi_penitipan', 'penitipan.id', '=', 'transaksi_penitipan.id_penitipan')
      ->join('users', 'penitipan.id_petugas', '=', 'users.id')
      ->get();

      return view('admin.data_penitipan', ['data' => $data]);
    }
}
