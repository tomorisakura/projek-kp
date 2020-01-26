<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Pelanggan;
use App\Hewan;
use App\Medis;
use App\Jenis;
use App\Penyakit;
use App\TransMedis;
use DateTime;
Use Alert;

class RmedicalController extends Controller
{
    public function index() {
      $pelanggan = Pelanggan::all();
      $penyakit = Penyakit::all();
      $jenis = Jenis::all();

      if (session('success_message')) {
        Alert::success('Berhasil Ditambahkan', session('success_message'));
      }

      return view('admin.rmedic', compact('pelanggan', 'penyakit', 'jenis'));
    }

    public function storeMedis(Request $request) {

      $det_transaksi = new TransMedis;
      $t_medis = new Medis;

      Validator::make($request->all(), [
        'no_medis' => ['required', 'string', 'max:255'],
        'nama_hewan' => ['required', 'string', 'max:255'],
        'ras_hewan' => ['required', 'string', 'max:255'],
        'tgl_mulai_penyakit' => ['required', 'string', 'max:255'],
        'nama_penyakit' => ['required', 'string', 'max:255'],
        'status_tindakan' => ['required'],
      ]);

      $t_medis->tgl_periksa = $request->tgl_periksa;
      $t_medis->total_biaya = $request->total_biaya;
      $t_medis->id_pemilik = $request->id_pemilik;
      $t_medis->status_pembayaran = $request->status_pembayaran;
      $t_medis->save();
      // dd($t_medis);

      $det_transaksi->no_medis = $request->no_medis;
      $det_transaksi->nama_hewan = $request->nama_hewan;
      $det_transaksi->jk_hewan = $request->jk_hewan;
      $det_transaksi->ras_hewan = $request->ras_hewan;
      $det_transaksi->gejala = $request->gejala;
      $det_transaksi->id_jenis = $request->id_jenis;
      $det_transaksi->id_penyakit = $request->id_penyakit;
      $det_transaksi->id_petugas = $request->id_petugas;
      // dd($det_transaksi);
      $t_medis->detail_transaksi_medis()->save($det_transaksi);

      return redirect('/adm/rekam-medis')->withSuccessMessage('Data Berhasil Ditambahkan');
    }

    public function getDataPemilik(Request $request ,$id) {
      $data = Pelanggan::find($id);
      echo json_encode($data);
    }
}
