<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DataPenitipanController extends Controller
{
    public function index() {

      $pelanggan = DB::table('transaksi_penitipan')
      ->join('pelanggan', 'transaksi_penitipan.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_penitipan', 'transaksi_penitipan.id', '=', 'detail_transaksi_penitipan.id_penitipan')
      ->select('transaksi_penitipan.*', 'pelanggan.*', 'transaksi_penitipan.id as p_id')
      ->orderBy('transaksi_penitipan.created_at', 'DESC')
      ->groupBy('transaksi_penitipan.id_pemilik')
      ->get();

      return view('admin.data_penitipan', compact('pelanggan'));
    }

    public function detail_transaksi(Request $request, $id) {

      $det_transaksi = DB::table('transaksi_penitipan')
      ->join('pelanggan', 'transaksi_penitipan.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_penitipan as det_penitipan', 'transaksi_penitipan.id', '=', 'det_penitipan.id_penitipan')
      ->select('pelanggan.*', 'det_penitipan.*', 'transaksi_penitipan.*', DB::raw('SUM(transaksi_penitipan.total_biaya) as total_harga'))
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->get();

      $det_penitipan = DB::table('detail_transaksi_penitipan as det_penitipan')
      ->join('transaksi_penitipan', 'det_penitipan.id_penitipan', '=', 'transaksi_penitipan.id')
      ->join('jenis_hewan', 'det_penitipan.id_jenis', '=', 'jenis_hewan.id')
      ->join('users', 'det_penitipan.id_petugas', '=', 'users.id')
      ->select('det_penitipan.*', 'jenis_hewan.*', 'users.*', 'transaksi_penitipan.*')
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->get();

      return view('admin.detail_trans_penitipan', compact('det_transaksi', 'det_penitipan'));
    }

    public function pdf($id) {
      $pdf = \App::make('dompdf.wrapper');

      $data_transaksi = DB::table('transaksi_penitipan')
      ->join('pelanggan', 'transaksi_penitipan.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_penitipan as det_penitipan', 'transaksi_penitipan.id', '=', 'det_penitipan.id_penitipan')
      ->select('pelanggan.*', 'det_penitipan.*', 'transaksi_penitipan.*', DB::raw('SUM(transaksi_penitipan.total_biaya) as total_harga'))
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->get();

      $data_penitipan = DB::table('detail_transaksi_penitipan as det_penitipan')
      ->join('transaksi_penitipan', 'det_penitipan.id_penitipan', '=', 'transaksi_penitipan.id')
      ->join('jenis_hewan', 'det_penitipan.id_jenis', '=', 'jenis_hewan.id')
      ->join('users', 'det_penitipan.id_petugas', '=', 'users.id')
      ->select('det_penitipan.*', 'jenis_hewan.*', 'users.*', 'transaksi_penitipan.*')
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->get();

      $pdf = PDF::loadView('admin.invoice_penitipan', compact('data_transaksi','data_penitipan'))->setPaper('a4', 'landscape');
      return $pdf->stream();
    }
}
