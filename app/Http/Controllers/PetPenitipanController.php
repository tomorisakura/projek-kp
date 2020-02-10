<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Pelanggan;
use App\Jenis;
use App\Penitipan;
use App\TransPenitipan;
Use Alert;


class PetPenitipanController extends Controller
{

  public function index() {
    $pelanggan = Pelanggan::all();
    $jenis = Jenis::all();

    if (session('success_message')) {
      Alert::success('Berhasil Ditambahkan', session('success_message'));
    }

    return view('admin.penitipan', compact('pelanggan', 'jenis'));
  }

  public function storePenitipan(Request $request) {

    $transaksi = new TransPenitipan;
    $penitipan = new Penitipan;
    $id = $request['no_penitipan'];

    Validator::make($request->all(), [
      'id_trans_medis' => ['required', 'string', 'max:255'],
      'no_penitipan' => ['required', 'string', 'max:255'],
      'nama_hewan' => ['required', 'string', 'max:255'],
      'ras_hewan' => ['required', 'string', 'max:255'],
      'jenis_hewan' => ['required', 'string', 'max:255'],
      'tgl_masuk' => ['required', 'string', 'max:255'],
      'tgl_keluar' => ['required', 'string', 'max:255'],
      'no_kandang' => ['required'],
    ]);

    $validate  = Penitipan::find($id);
    
    if($validate == "") {
      
      $penitipan->id = $request->no_penitipan;
      $penitipan->tgl_masuk = $request->tgl_masuk;
      $penitipan->tgl_keluar = $request->tgl_keluar;
      $penitipan->total_biaya = $request->total_harga;
      $penitipan->id_pemilik = $request->id_pemilik;
      $penitipan->status_pembayaran = $request->status_pembayaran;
      // dd($penitipan);
      $penitipan->save();
      
      $transaksi->nama_hewan = $request->nama_hewan;
      $transaksi->jk_hewan = $request->jk_hewan;
      $transaksi->ras_hewan = $request->ras_hewan;
      $transaksi->no_kandang = $request->no_kandang;
      $transaksi->id_penitipan = $request->no_penitipan;
      $transaksi->harga_detail = $request->total_harga;
      $transaksi->jenis_kandang = $request->jenis_kandang;
      $transaksi->id_jenis = $request->id_hewan;
      $transaksi->id_petugas = $request->id_petugas;
      $transaksi->save();

      return redirect('/adm/penitipan')->withSuccessMessage('Transaksi Baru, Berhasil Ditambahkan');
      // dd($validate);

    } else {

      $pet = Penitipan::find($id);
      $pet->total_biaya = $transaksi->sum('harga_detail');
      dd($pet);
      $pet->save();

      $transaksi->nama_hewan = $request->nama_hewan;
      $transaksi->jk_hewan = $request->jk_hewan;
      $transaksi->ras_hewan = $request->ras_hewan;
      $transaksi->no_kandang = $request->no_kandang;
      $transaksi->id_penitipan = $request->no_penitipan;
      $transaksi->harga_detail = $request->total_harga;
      $transaksi->jenis_kandang = $request->jenis_kandang;
      $transaksi->id_jenis = $request->id_hewan;
      $transaksi->id_petugas = $request->id_petugas;
      $transaksi->save();

      return redirect('/adm/penitipan')->withSuccessMessage('Transaksi Berhasil Ditambahkan');

    }


    return redirect('/adm/penitipan')->withSuccessMessage('Data Berhasil Ditambahkan');

  }

  public function getDataPemilik(Request $request ,$id) {
    $data = Pelanggan::find($id);
    echo json_encode($data);
  }

  public function getDataDetail() {
    $data = Penitipan::all();
    echo json_encode($data);
  }

  public function getDataDetailPenitipan($id) {

    // $id = $request['no_penitipan'];
    $datass = Penitipan::find($id);

    $datas = DB::table('transaksi_penitipan')
    ->join('pelanggan', 'transaksi_penitipan.id_pemilik', '=', 'pelanggan.id')
    ->join('detail_transaksi_penitipan as det_penitipan', 'transaksi_penitipan.id', '=', 'det_penitipan.id_penitipan')
    ->select('pelanggan.*', 'det_penitipan.*', 'transaksi_penitipan.*')
    ->where('transaksi_penitipan.id', '=', $id)
    ->first();

    echo json_encode($datas);
  }

}
