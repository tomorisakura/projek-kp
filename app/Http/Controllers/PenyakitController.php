<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyakit;
Use Alert;

class PenyakitController extends Controller
{
    public function index() {
        $data = Penyakit::all();
        return view('admin.penyakit', compact('data'));
    }

    public function create(Request $req) {

        $penyakit = Penyakit::where('nama_penyakit', $req->nama_penyakit)->first();

        if ($penyakit) {
            Alert::error('Gagal', 'Nama Indikasi Sudah Ada !');
            return redirect('adm/penyakit');
        } else {

            $data = array(
                'nama_penyakit' => $req['nama_penyakit'],
                'harga' => $req['harga']
            );
    
            Penyakit::create($data);
            Alert::success('Berhasil', 'Data '.$req->nama_penyakit.' Telah Ditambahkan !');
            return redirect('adm/penyakit/');

        }
    }

    public function getDataPenyakit($id) {
        $data = Penyakit::find($id);
        echo json_encode($data);
    }

    public function update(Request $request, $id) {
        $data = Penyakit::find($id);

        $data->nama_penyakit = $request->get('nama_edit');
        $data->harga = $request->get('harga_edit');
        $data->save();
        echo "sukses";
        return view('admin.penyakit');
    }

    public function delete(Request $request, $id) {
        $data = Penyakit::find($id);
        $data->delete($id);
    }
}
