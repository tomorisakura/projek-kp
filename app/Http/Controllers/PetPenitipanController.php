<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use App\Hewan;
use App\Penitipan;
use App\TransPenitipan;
Use Alert;



class PetPenitipanController extends Controller
{

  public function index() {
    $pelanggan = Pelanggan::all();

    return view('admin.penitipan', compact('pelanggan'));
  }

  public function storePenitipan(Request $request, $id) {

    $hewan = new Hewan;
    $pemilik = Pelanggan::find($id);
    $transaksi = new TransPenitipan;
    $penitipan = new Penitipan;

    $hewan->nama_hewan = $request->nama_hewan;
    $hewan->jenis_hewan = $request->jenis_hewan;
    $hewan->jk_hewan = $request->jk_hewan;
    $hewan->ras_hewan = $request->ras_hewan;
    $hewan->id_pemilik = $request->id_pemilik;
    $hewan->save();

    $penitipan->tgl_masuk = $request->tgl_masuk;
    $penitipan->tgl_keluar = $request->tgl_keluar;
    $penitipan->no_kandang = $request->no_kandang;
    $penitipan->id_hewan = $request->id_hewan;
    $penitipan->id_petugas = $request->id_petugas;
    $hewan->penitipan()->save($penitipan);

    $transaksi->harga = $request->harga;
    $transaksi->total_harga = $request->total_harga;
    $transaksi->id_penitipan = $request->id_penitipan;
    $transaksi->id_petugas = $request->id_petugas;
    $penitipan->transaksi_penitipan()->save($transaksi);
    // dd($transaksi);

    return redirect('/adm/penitipan');

  }

  public function getDataPemilik(Request$request ,$id) {
    $data = Pelanggan::find($id);
    echo json_encode($data);
  }

}
