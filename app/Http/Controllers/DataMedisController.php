<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use App\Medis;
use Illuminate\Support\Facades\DB;
use PDF;

class DataMedisController extends Controller
{
    public function index() {

      // $pelanggan = Pelanggan::all();
      $pelanggan = DB::table('transaksi_medis')
      ->join('pelanggan', 'transaksi_medis.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_medis', 'transaksi_medis.id', '=', 'detail_transaksi_medis.id_medis')
      ->join('users', 'transaksi_medis.id_petugas', '=', 'users.id')
      ->select('transaksi_medis.id as m_id', 'pelanggan.*', 'detail_transaksi_medis.*', 'transaksi_medis.*', 'pelanggan.id as pe_id')
      ->orderBy('transaksi_medis.created_at', 'DESC')
      ->groupBy('transaksi_medis.id')
      ->get();
      
      return view('admin.data_medis', compact('pelanggan'));
    }

    public function detail_transaksi(Request $request, $id) {
      $data_det = DB::table('detail_transaksi_medis')
      ->join('transaksi_medis', 'detail_transaksi_medis.id_medis', '=', 'transaksi_medis.id')
      ->join('jenis_hewan', 'detail_transaksi_medis.id_jenis', '=', 'jenis_hewan.id')
      ->join('penyakit', 'detail_transaksi_medis.id_penyakit', '=', 'penyakit.id')
      ->select('detail_transaksi_medis.*', 'jenis_hewan.nama', 'penyakit.nama_penyakit')
      ->where('detail_transaksi_medis.id_medis', '=', $id)
      ->get();

      $data_trans = DB::table('transaksi_medis')
      ->join('pelanggan', 'transaksi_medis.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_medis', 'transaksi_medis.id', '=', 'detail_transaksi_medis.id_medis')
      ->join('users', 'transaksi_medis.id_petugas', '=', 'users.id')
      ->select('detail_transaksi_medis.harga_detail', 'transaksi_medis.tgl_periksa', 'users.name', 'transaksi_medis.status_pembayaran',  'pelanggan.id as id_pel', 'pelanggan.*', DB::raw('SUM(detail_transaksi_medis.harga_detail) as total_harga'))
      ->where('transaksi_medis.id', '=' , $id)
      ->first();

      return view('admin.detail_trans_medis', compact('data_trans', 'data_det'));
    }

    public function pdf($id) {
      $pdf = \App::make('dompdf.wrapper');

      $data_det = DB::table('detail_transaksi_medis')
      ->join('transaksi_medis', 'detail_transaksi_medis.id_medis', '=', 'transaksi_medis.id')
      ->join('jenis_hewan', 'detail_transaksi_medis.id_jenis', '=', 'jenis_hewan.id')
      ->join('penyakit', 'detail_transaksi_medis.id_penyakit', '=', 'penyakit.id')
      ->select('detail_transaksi_medis.*', 'jenis_hewan.nama', 'penyakit.nama_penyakit')
      ->where('detail_transaksi_medis.id_medis', '=', $id)
      ->get();

      $data_trans = DB::table('transaksi_medis')
      ->join('pelanggan', 'transaksi_medis.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_medis', 'transaksi_medis.id', '=', 'detail_transaksi_medis.id_medis')
      ->join('users', 'transaksi_medis.id_petugas', '=', 'users.id')
      ->select('transaksi_medis.*', 'transaksi_medis.tgl_periksa', 'users.name' , 'transaksi_medis.status_pembayaran',  'pelanggan.nama_pemilik', DB::raw('SUM(detail_transaksi_medis.harga_detail) as total_harga'))
      ->where('transaksi_medis.id', '=' , $id)
      ->get();

      $customPaper = array(0,0,580.00,453.80);

      $pdf = PDF::loadView('admin.invoice', compact('data_trans','data_det'))->setPaper($customPaper, 'portrait');
      return $pdf->stream();
    }

    public function getDetailTotal($id) {
      $data_det = DB::table('detail_transaksi_medis')
      ->join('transaksi_medis', 'detail_transaksi_medis.id_medis', '=', 'transaksi_medis.id')
      ->join('jenis_hewan', 'detail_transaksi_medis.id_jenis', '=', 'jenis_hewan.id')
      ->join('penyakit', 'detail_transaksi_medis.id_penyakit', '=', 'penyakit.id')
      ->select('transaksi_medis.*', 'jenis_hewan.*', 'penyakit.*', 'detail_transaksi_medis.*')
      ->where('detail_transaksi_medis.id_medis', '=', $id)
      ->get();

      echo json_encode($data);
    }

    public function transaksi() {
      $data = Medis::all();
      echo json_encode($data);
    }
}
