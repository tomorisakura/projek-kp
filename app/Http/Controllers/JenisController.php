<?php

namespace App\Http\Controllers;
use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use Alert;

class JenisController extends Controller
{
    public function index() {
        $jenis = Jenis::all();
        return view('admin.jenis', compact('jenis'));
    }

    public function create(Request $request) {

        $hewan = Jenis::where('nama', $request->nama_jenis)->first();

        if($hewan) {
            Alert::error('Gagal', 'Nama Hewan Sudah Ada !');

            return redirect('/adm/jenis-hewan');
        } else {
            $jenis = array(
                'nama' => $request['nama_jenis'],
                'harga' => $request['harga_jenis']
              );
      
            Validator::make($request->all(), [
                'nama_jenis' => ['required', 'string', 'max:255'],
                'harga_jenis' => ['required', 'string', 'max:255']
            ]);
        
            Jenis::create($jenis);
            $jenis = Jenis::all();
        
            return redirect('/adm/jenis-hewan')->withSuccessMessage( 'Data '.$request->nama_jenis.' Berhasil Ditambahkan');
        }
    }

    public function getDataJenis($id) {
        $jenis = Jenis::find($id);
        echo json_encode($jenis);
    }

    public function update(Request $request) {
        $id = $request->idJenis;
        $data = Jenis::find($id);

        $data->nama = $request->get('nama');
        $data->harga = $request->get('harga');
        $data->save();
        echo "sukses";

        Alert::success('Data Berhasil Diupdate', $request->nama . " Berhasil Diganti");
        return redirect('/adm/jenis-hewan');
    }

    public function delete(Request $request, $id) {
        $data = Jenis::find($id);
        $data->delete($id);
    }
}
