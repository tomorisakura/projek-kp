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
      $id = $request['no_medis'];

      Validator::make($request->all(), [
        'id_trans_medis' => ['required', 'string', 'max:255'],
        'no_medis' => ['required', 'string', 'max:255'],
        'nama_hewan' => ['required', 'string', 'max:255'],
        'ras_hewan' => ['required', 'string', 'max:255'],
        'tgl_periksa' => ['required', 'string', 'max:255'],
        'nama_penyakit' => ['required', 'string', 'max:255'],
        'status_tindakan' => ['required'],
      ]);

      $validate = Medis::find($id);
      $sum_total = $det_transaksi->sum('harga_detail');

      if($validate == "") {

        $t_medis->id = $request->no_medis;
        $t_medis->tgl_periksa = $request->tgl_periksa;
        $t_medis->total_biaya = $request->total_biaya;
        $t_medis->id_pemilik = $request->id_pemilik;
        $t_medis->status_pembayaran = $request->status_pembayaran;
        $t_medis->id_petugas = $request->id_petugas;
        $t_medis->save();
  
        $det_transaksi->nama_hewan = $request->nama_hewan;
        $det_transaksi->jk_hewan = $request->jk_hewan;
        $det_transaksi->ras_hewan = $request->ras_hewan;
        $det_transaksi->gejala = $request->gejala;
        $det_transaksi->harga_detail = $request->total_biaya;
        $det_transaksi->id_medis = $request->no_medis;
        $det_transaksi->id_jenis = $request->id_jenis;
        $det_transaksi->id_penyakit = $request->id_penyakit;
        $det_transaksi->save();

        return redirect('/adm/rekam-medis')->withSuccessMessage('Transaksi Baru, Berhasil Ditambahkan');

      } else {

        $id_pemilik = $request->id_pemilik;

        $validate = Medis::find($id);
        
        if($validate->id_pemilik != $id_pemilik) {
          // dd($validate);

          Alert::error('Terjadi Kesalahan', 'Pastikan ID Transaksi dan Pemilik Relevan !');

          return redirect('/adm/rekam-medis');

        } else {

          $medic = Medis::find($id);
          $medic->total_biaya = $request->total_harga_baru;
          $medic->save();
  
          $det_transaksi->nama_hewan = $request->nama_hewan;
          $det_transaksi->jk_hewan = $request->jk_hewan;
          $det_transaksi->ras_hewan = $request->ras_hewan;
          $det_transaksi->gejala = $request->gejala;
          $det_transaksi->harga_detail = $request->total_biaya;
          $det_transaksi->id_medis = $request->no_medis;
          $det_transaksi->id_jenis = $request->id_jenis;
          $det_transaksi->id_penyakit = $request->id_penyakit;
          $det_transaksi->save();
  
          return redirect('/adm/rekam-medis')->withSuccessMessage('Transaksi Berhasil Ditambahkan');

        }

      }

      return redirect('/adm/rekam-medis')->withSuccessMessage('Hmm Kurang Greget');
    }

    public function getDataPemilik(Request $request ,$id) {
      $data = Pelanggan::find($id);
      echo json_encode($data);
    }

    public function getDataDetail() {
      $data = TransMedis::all();
      echo json_encode($data);
    }

    public function getDataDetailMedis($id) {

      $datas = DB::table('transaksi_medis')
      ->join('pelanggan', 'transaksi_medis.id_pemilik', '=', 'pelanggan.id')
      ->join('detail_transaksi_medis as det_medis', 'transaksi_medis.id', '=', 'det_medis.id_medis')
      ->select('pelanggan.*', 'det_medis.*', 'transaksi_medis.*')
      ->where('transaksi_medis.id', '=', $id)
      ->first();
  
      echo json_encode($datas);
    }
}
