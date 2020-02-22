<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Penitipan;
use PDF;
use Alert;

class DataPenitipanController extends Controller
{
    public function index() {

      $pelanggan = DB::table('transaksi_penitipan')
      ->join('pelanggan', 'transaksi_penitipan.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_penitipan', 'transaksi_penitipan.id', '=', 'detail_transaksi_penitipan.id_penitipan')
      ->select('transaksi_penitipan.*', 'pelanggan.*', 'transaksi_penitipan.id as p_id')
      ->orderBy('transaksi_penitipan.created_at', 'DESC')
      ->groupBy('transaksi_penitipan.id')
      ->get();

      return view('admin.data_penitipan', compact('pelanggan'));
    }

    public function detail_transaksi(Request $request, $id) {

      $det_transaksi = DB::table('transaksi_penitipan')
      ->join('pelanggan', 'transaksi_penitipan.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_penitipan as det_penitipan', 'transaksi_penitipan.id', '=', 'det_penitipan.id_penitipan')
      ->join('users', 'transaksi_penitipan.id_petugas', '=', 'users.id')
      ->select('pelanggan.*', 'pelanggan.id as id_pel', 'det_penitipan.*', 'users.name', 'transaksi_penitipan.*', 'transaksi_penitipan.total_biaya as tot_biaya', DB::raw('SUM(det_penitipan.harga_detail) as total_harga'))
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->first();

      $det_penitipan = DB::table('detail_transaksi_penitipan as det_penitipan')
      ->join('transaksi_penitipan', 'det_penitipan.id_penitipan', '=', 'transaksi_penitipan.id')
      ->join('jenis_hewan', 'det_penitipan.id_jenis', '=', 'jenis_hewan.id')
      ->select('det_penitipan.*', 'jenis_hewan.*', 'transaksi_penitipan.*', 'jenis_hewan.harga as harga_hewan')
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->orderBy('det_penitipan.nama_hewan')
      ->get();

      return view('admin.detail_trans_penitipan', compact('det_transaksi', 'det_penitipan'));
    }

    public function updateDetailPenitipan(Request $request) {
      $id = $request->id_transaksi;
      $detail = Penitipan::find($id);
      $detail->tgl_keluar = $request->get('tgl_keluar');
      $detail->total_biaya = $request->get('total_harga');
      $detail->status_pembayaran = $request->get('status_pembayaran');
      $detail->save();

      Alert::success('Data Berhasil Disimpan', 'Transaksi dengan nomor '. $id . " berhasil diubah !");

      return redirect('/adm/data-penitipan/get/'.$id);

    }

    public function pdf($id) {
      $pdf = \App::make('dompdf.wrapper');

      $data_transaksi = DB::table('transaksi_penitipan')
      ->join('pelanggan', 'transaksi_penitipan.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_penitipan as det_penitipan', 'transaksi_penitipan.id', '=', 'det_penitipan.id_penitipan')
      ->join('users', 'transaksi_penitipan.id_petugas', '=', 'users.id')
      ->select('pelanggan.*', 'det_penitipan.*', 'transaksi_penitipan.*' , 'users.name', DB::raw('SUM(det_penitipan.harga_detail) as total_harga'))
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->get();

      $data_penitipan = DB::table('detail_transaksi_penitipan as det_penitipan')
      ->join('transaksi_penitipan', 'det_penitipan.id_penitipan', '=', 'transaksi_penitipan.id')
      ->join('jenis_hewan', 'det_penitipan.id_jenis', '=', 'jenis_hewan.id')
      ->select('det_penitipan.*', 'jenis_hewan.*', 'transaksi_penitipan.*', 'jenis_hewan.harga as harga_hewan')
      ->where('det_penitipan.id_penitipan', '=', $id)
      ->get();

      $customPaper = array(0,0,580.00,453.80);

      $pdf = PDF::loadView('admin.invoice_penitipan', compact('data_transaksi','data_penitipan'))->setPaper($customPaper, 'portrait');
      return $pdf->stream();
    }
}
